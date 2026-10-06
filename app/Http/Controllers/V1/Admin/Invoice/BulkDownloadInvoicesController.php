<?php

namespace App\Http\Controllers\V1\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkDownloadInvoicesRequest;
use App\Models\CompanySetting;
use App\Models\Invoice;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class BulkDownloadInvoicesController extends Controller
{
    /**
     * Bundle the PDFs of the selected invoices into one ZIP download.
     *
     * Stored PDFs are reused; invoices without one are rendered on the fly,
     * the same way the single-invoice PDF endpoint does it.
     */
    public function __invoke(BulkDownloadInvoicesRequest $request): BinaryFileResponse
    {
        $this->authorize('viewAny', Invoice::class);

        $invoices = Invoice::whereCompany()
            ->whereIn('id', $request->ids)
            ->orderBy('invoice_number')
            ->get();

        abort_if($invoices->isEmpty(), 404);

        $zipPath = tempnam(sys_get_temp_dir(), 'invoices-');
        $zip = new ZipArchive;
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($invoices as $invoice) {
            $this->authorize('view', $invoice);

            $name = $invoice->invoice_number.'.pdf';

            if ($zip->locateName($name) !== false) {
                $name = $invoice->invoice_number.'-'.$invoice->id.'.pdf';
            }

            $zip->addFromString($name, $this->pdfContents($invoice));
        }

        $zip->close();

        $fileName = 'invoices-'.now()->format('Y-m-d').'.zip';

        return response()
            ->download($zipPath, $fileName, ['Content-Type' => 'application/zip'])
            ->deleteFileAfterSend();
    }

    /**
     * Return the stored PDF for the invoice, or render it.
     */
    private function pdfContents(Invoice $invoice): string
    {
        $stored = $invoice->getGeneratedPDF('invoice');

        if ($stored && file_exists($stored['path'])) {
            return file_get_contents($stored['path']);
        }

        App::setLocale(CompanySetting::getSetting('language', $invoice->company_id));

        return $invoice->getPDFData()->output();
    }
}
