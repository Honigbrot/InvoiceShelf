<?php

namespace App\Http\Controllers\V1\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use App\Models\ExchangeRateLog;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\SerialNumberFormatter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class BulkPayInvoicesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $this->authorize('create', Payment::class);

        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'required|integer',
        ]);

        // Fetch invoices that are eligible for payment
        $invoices = Invoice::whereCompany()
            ->whereIn('id', $request->ids)
            ->whereIn('status', [Invoice::STATUS_SENT, Invoice::STATUS_VIEWED])
            ->where('due_amount', '>', 0)
            ->with('customer')
            ->get();

        $paymentsCreated = 0;
        $company_id = $request->header('company');

        foreach ($invoices as $invoice) {
            // Generate serial numbers first
            $serial = (new SerialNumberFormatter())
                ->setModel(new Payment())
                ->setCompany($company_id)
                ->setCustomer($invoice->customer_id)
                ->setNextNumbers();

            // Prepare payment data
            $paymentData = [
                'payment_date' => Carbon::now(),
                'payment_number' => $serial->getNextNumber(),
                'amount' => $invoice->due_amount,
                'customer_id' => $invoice->customer_id,
                'invoice_id' => $invoice->id,
                'currency_id' => $invoice->currency_id,
                'exchange_rate' => $invoice->exchange_rate,
                'base_amount' => $invoice->due_amount * $invoice->exchange_rate,
                'payment_method_id' => null,
                'company_id' => $company_id,
                'creator_id' => $request->user()->id,
                'notes' => null,
            ];

            // Create the payment
            $payment = Payment::create($paymentData);
            
            // Generate unique hash and update sequence numbers
            $payment->unique_hash = Hashids::connection(Payment::class)->encode($payment->id);
            $payment->sequence_number = $serial->nextSequenceNumber;
            $payment->customer_sequence_number = $serial->nextCustomerSequenceNumber;
            $payment->save();

            // Log exchange rate if different from company currency
            $company_currency = CompanySetting::getSetting('currency', $company_id);
            if ((string) $payment->currency_id !== $company_currency) {
                ExchangeRateLog::addExchangeRateLog($payment);
            }

            // Update invoice due amount and status
            $invoice->subtractInvoicePayment($payment->amount);

            $paymentsCreated++;
        }

        return response()->json([
            'success' => true,
            'payments_created' => $paymentsCreated,
        ]);
    }
}

