<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Lightweight shape for the invoice list, view sidebar and payment invoice picker.
 *
 * InvoiceResource embeds company, items, taxes and custom fields per row,
 * which costs hundreds of queries per page.
 */
class InvoiceListResource extends JsonResource
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
            'invoice_number' => $this->invoice_number,
            'invoice_date' => $this->invoice_date,
            'due_date' => $this->due_date,
            'formatted_invoice_date' => $this->formattedInvoiceDate,
            'formatted_due_date' => $this->formattedDueDate,
            'status' => $this->status,
            'paid_status' => $this->paid_status,
            'overdue' => $this->overdue,
            'sent' => $this->sent,
            'viewed' => $this->viewed,
            'total' => $this->total,
            'due_amount' => $this->due_amount,
            'exchange_rate' => $this->exchange_rate,
            'unique_hash' => $this->unique_hash,
            'allow_edit' => $this->allow_edit,
            'customer_id' => $this->customer_id,
            'company_id' => $this->company_id,
            'currency_id' => $this->currency_id,
            'recurring_invoice_id' => $this->recurring_invoice_id,
            'customer' => new CustomerSummaryResource($this->whenLoaded('customer')),
            'currency' => new CurrencyResource($this->whenLoaded('currency')),
        ];
    }
}
