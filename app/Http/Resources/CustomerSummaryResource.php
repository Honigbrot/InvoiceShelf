<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Customer fields needed by list views (name, send-mail default, money formatting).
 */
class CustomerSummaryResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'contact_name' => $this->contact_name,
            'currency' => $this->whenLoaded('currency', fn () => $this->currency
                ? new CurrencyResource($this->currency)
                : null),
        ];
    }
}
