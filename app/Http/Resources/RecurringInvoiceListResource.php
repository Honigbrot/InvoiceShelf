<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Lightweight shape for the recurring invoice list and view sidebar.
 *
 * RecurringInvoiceResource embeds every generated invoice with its own nested
 * relations, which made the index endpoint issue thousands of queries.
 */
class RecurringInvoiceListResource extends JsonResource
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
            'starts_at' => $this->starts_at,
            'formatted_starts_at' => $this->formattedStartsAt,
            'formatted_next_invoice_at' => $this->formattedNextInvoiceAt,
            'next_invoice_at' => $this->next_invoice_at,
            'customer_id' => $this->customer_id,
            'company_id' => $this->company_id,
            'status' => $this->status,
            'frequency' => $this->frequency,
            'send_automatically' => $this->send_automatically,
            'total' => $this->total,
            'customer' => $this->whenLoaded('customer', fn () => [
                'id' => $this->customer->id,
                'name' => $this->customer->name,
                'contact_name' => $this->customer->contact_name,
                'currency' => $this->customer->currency
                    ? new CurrencyResource($this->customer->currency)
                    : null,
            ]),
        ];
    }
}
