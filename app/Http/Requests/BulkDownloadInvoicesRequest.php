<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkDownloadInvoicesRequest extends FormRequest
{
    /**
     * Maximum number of invoices per ZIP, to keep PDF rendering within the request timeout.
     */
    public const MAX_INVOICES = 50;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'ids' => [
                'required',
                'array',
                'min:1',
                'max:'.self::MAX_INVOICES,
            ],
            'ids.*' => [
                'required',
                'integer',
            ],
        ];
    }
}
