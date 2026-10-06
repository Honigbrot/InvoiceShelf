<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Lightweight shape for the estimate list and view sidebar.
 */
class EstimateListResource extends JsonResource
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
            'estimate_number' => $this->estimate_number,
            'estimate_date' => $this->estimate_date,
            'expiry_date' => $this->expiry_date,
            'formatted_estimate_date' => $this->formattedEstimateDate,
            'formatted_expiry_date' => $this->formattedExpiryDate,
            'status' => $this->status,
            'total' => $this->total,
            'exchange_rate' => $this->exchange_rate,
            'unique_hash' => $this->unique_hash,
            'customer_id' => $this->customer_id,
            'company_id' => $this->company_id,
            'currency_id' => $this->currency_id,
            'customer' => new CustomerSummaryResource($this->whenLoaded('customer')),
            'currency' => new CurrencyResource($this->whenLoaded('currency')),
        ];
    }
}
