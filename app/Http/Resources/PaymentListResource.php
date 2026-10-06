<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Lightweight shape for the payment list and view sidebar.
 */
class PaymentListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'payment_number' => $this->payment_number,
            'payment_date' => $this->payment_date,
            'formatted_payment_date' => $this->formattedPaymentDate,
            'amount' => $this->amount,
            'exchange_rate' => $this->exchange_rate,
            'unique_hash' => $this->unique_hash,
            'invoice_id' => $this->invoice_id,
            'invoice_number' => $this->invoice_number,
            'customer_id' => $this->customer_id,
            'company_id' => $this->company_id,
            'currency_id' => $this->currency_id,
            'payment_method_id' => $this->payment_method_id,
            'customer' => new CustomerSummaryResource($this->whenLoaded('customer')),
            'currency' => new CurrencyResource($this->whenLoaded('currency')),
            'payment_method' => $this->whenLoaded('paymentMethod', fn () => $this->paymentMethod ? [
                'id' => $this->paymentMethod->id,
                'name' => $this->paymentMethod->name,
            ] : null),
        ];
    }
}
