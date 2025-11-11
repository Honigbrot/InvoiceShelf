<!DOCTYPE html>
<html>

<head>
    <title>@lang('pdf_invoice_label') - {{ $invoice->invoice_number }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css">
        /* -- Base -- */
        body {
            font-family: "DejaVu Sans";
            margin-top: 30px;
            margin-bottom: 0px;
            margin-left: 0px;
            margin-right: 0px;
        }

        html {
            margin: 0px;
            padding: 0px;
        }

        .text-center {
            text-align: center;
        }

        hr {
            margin: 0 30px 0 30px;
            color: rgba(0, 0, 0, 0.2);
            border: 0.5px solid #EAF1FB;
        }

     

        .content-wrapper {
            display: block;
            margin-top: 0px;
            padding-top: 0px;
            padding-bottom: 20px;
            margin-bottom: 120px;
        }

        .company-address-container {
            padding-top: 15px;
            padding-left: 30px;
            float: left;
            width: 40%;
            margin-bottom: 2px;
        }

        .company-address-container h1 {
            font-size: 15px;
            line-height: 22px;
            letter-spacing: 0.05em;
            margin-bottom: 0px;
            margin-top: 10px;
        }

        .company-address {
            margin-top: 16px;
            text-align: left;
            font-size: 12px;
            line-height: 15px;
            color: #595959;
            width: 350px;
            word-wrap: break-word;
        }

        .invoice-details-container {
            float: right;
            padding: 10px 30px 0 0;
            margin-top: 18px;
        }

        .attribute-label {
            font-size: 12px;
            line-height: 18px;
            padding-right: 40px;
            text-align: left;
            color: #55547A;
        }

        .attribute-value {
            font-size: 12px;
            line-height: 18px;
            text-align: right;
        }

        /* -- Shipping -- */

        .shipping-address-container {
            float: right;
            padding-left: 40px;
            width: 220px;
        }

        .shipping-address {
            font-size: 12px;
            line-height: 15px;
            color: #595959;
            padding: 45px 0px 0px 40px;
            margin: 0px;
            width: 220px;
            word-wrap: break-word;
        }

        /* -- Billing -- */

        .billing-address-container {
            padding-top: 50px;
            float: left;
            padding-left: 30px;
        }

        .billing-address-label {
            font-size: 12px;
            line-height: 18px;
            padding: 0px;
            margin-top: 27px;
            margin-bottom: 0px;
        }

        .billing-address-name {
            max-width: 220px;
            font-size: 15px;
            line-height: 22px;
            padding: 0px;
            margin: 0px;
        }

        .billing-address {
            font-size: 12px;
            line-height: 15px;
            color: #595959;
            padding: 45px 0px 0px 30px;
            margin: 0px;
            width: 220px;
            word-wrap: break-word;
        }

        /* -- Items Table -- */

        .items-table {
            margin-top: 35px;
            padding: 0px 30px 10px 30px;
            page-break-before: avoid;
            page-break-after: auto;
        }

        .items-table hr {
            height: 0.1px;
        }

        .item-table-heading {
            font-size: 13.5px;
            text-align: center;
            color: #55547A;
            padding: 5px;
        }

        .quantity-column-header {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        tr.item-table-heading-row th {
            border-bottom: 0.620315px solid #E8E8E8;
            font-size: 12px;
            line-height: 18px;
        }

        tr.item-row td {
            font-size: 12px;
            line-height: 18px;
        }

        .item-cell {
            font-size: 13px;
            text-align: center;
            padding: 5px;
            padding-top: 10px;
            color: #040405;
        }

        .item-description {
            color: #595959;
            font-size: 9px;
            line-height: 12px;
        }

        /* -- Total Display Table -- */

        .total-display-container {
            padding: 0 25px;
        }

        .total-display-table {
            border-top: none;
            page-break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
            margin-top: 20px;
            float: right;
            width: auto;
        }

        .total-table-attribute-label {
            font-size: 13px;
            color: #55547A;
            text-align: left;
            padding-left: 10px;
        }

        .total-table-attribute-value {
            font-weight: bold;
            text-align: right;
            font-size: 13px;
            color: #040405;
            padding-right: 10px;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .total-border-left {
            border: 1px solid #E8E8E8 !important;
            border-right: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        .total-border-right {
            border: 1px solid #E8E8E8 !important;
            border-left: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        /* -- Notes -- */

        .notes {
            font-size: 12px;
            color: #595959;
            margin-top: 15px;
            margin-left: 30px;
            width: 442px;
            text-align: left;
            page-break-inside: avoid;
        }

        .notes-label {
            font-size: 15px;
            line-height: 22px;
            letter-spacing: 0.05em;
            color: #040405;
            width: 108px;
            white-space: nowrap;
            height: 19.87px;
            padding-bottom: 10px;
        }

        /* -- Helpers -- */

        .text-primary {
            color: #5851DB;
        }


        table .text-left {
            text-align: left;
        }

        table .text-right {
            text-align: right;
        }

        .border-0 {
            border: none;
        }

        .py-2 {
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .py-8 {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .py-3 {
            padding: 3px 0;
        }

        .pr-20 {
            padding-right: 20px;
        }

        .pr-10 {
            padding-right: 10px;
        }

        .pl-20 {
            padding-left: 20px;
        }

        .pl-10 {
            padding-left: 10px;
        }

        .pl-0 {
            padding-left: 0;
        }

        /* -- Footer -- */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #f8f9fa;
            border-top: 1px solid #E8E8E8;
            padding: 20px 30px 15px 30px;
            font-size: 9px;
            line-height: 12px;
            color: #595959;
            page-break-inside: avoid;
        }

        .footer-content {
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            width: 33.33%;
            vertical-align: bottom;
            padding-right: 15px;
        }

        .footer-middle {
            display: table-cell;
            width: 33.33%;
            vertical-align: bottom;
            text-align: center;
            padding: 0 15px;
        }

        .footer-right {
            display: table-cell;
            width: 33.33%;
            vertical-align: bottom;
            text-align: right;
            padding-left: 15px;
        }

        .banking-info {
            font-weight: normal;
            color: #040405;
        }

        .banking-label {
            font-weight: normal;
            color: #55547A;
            margin-right: 4px;
        }

        .footer-company-name {
            font-weight: bold;
            color: #040405;
            font-size: 10px;
            margin-bottom: 6px;
        }

        .footer-address {
            margin-bottom: 3px;
            color: #595959;
        }

        .footer-contact {
            margin-bottom: 3px;
            color: #595959;
        }

        .footer-banking {
            margin-bottom: 5px;
        }

        /* -- Review Section -- */
        .review-section {
            position: fixed;
            bottom: 80px;
            left: 0;
            right: 0;
            padding: 20px 30px;
            text-align: center;
            page-break-inside: avoid;
        }

        .review-content {
            display: table;
            width: 100%;
            margin: 0 auto;
        }

        .review-text-container {
            display: table-cell;
            vertical-align: middle;
            text-align: left;
            padding-right: 20px;
        }

        .review-text {
            font-size: 13px;
            line-height: 18px;
            color: #040405;
            margin: 0;
        }

        .review-link {
            font-size: 12px;
            color: #5851DB;
            text-decoration: none;
            word-break: break-all;
        }

        .review-qr-container {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 100px;
        }

        .review-qr-code {
            width: 100px;
            height: 100px;
        }

    </style>

</head>

<body>
    <div class="content-wrapper">
        <div style="padding-top: 0px">
            <div class="company-address-container company-address">
                {!! $company_address !!}
            </div>

            <div class="invoice-details-container">
                <table>
                    <tr>
                        <td class="attribute-label">@lang('pdf_invoice_number')</td>
                        <td class="attribute-value"> &nbsp;{{ $invoice->invoice_number }}</td>
                    </tr>
                    <tr>
                        <td class="attribute-label">@lang('pdf_invoice_date')</td>
                        <td class="attribute-value"> &nbsp;{{ $invoice->formattedInvoiceDate }}</td>
                    </tr>
                    <tr>
                        <td class="attribute-label">@lang('pdf_invoice_due_date')</td>
                        <td class="attribute-value"> &nbsp;{{ $invoice->formattedDueDate }}</td>
                    </tr>
                    @if ($invoice->getFormattedString('{CUSTOM_INVOICE_LEISTUNGSZEITRAUM}'))
                    <tr>
                        <td class="attribute-label">Leistungszeitraum</td>
                        <td class="attribute-value"> &nbsp;{{ $invoice->getFormattedString('{CUSTOM_INVOICE_LEISTUNGSZEITRAUM}') }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <div style="clear: both;"></div>
        </div>

        <div class="billing-address-container billing-address">
            @if ($billing_address)
                <b>@lang('pdf_bill_to')</b> <br>

                {!! $billing_address !!}
            @endif
        </div>

        <div class="shipping-address-container shipping-address" @if ($billing_address && $billing_address !== '<br>') style="float:left;" @else style="display:block; float:left; padding-left: 0px;" @endif>
            @if ($shipping_address)
                <b>@lang('pdf_ship_to')</b> <br>

                {!! $shipping_address !!}
            @endif
        </div>

        <div style="position: relative; clear: both;">
            @include('pdf_templates::invoice.partials.table')
        </div>

        <div class="notes">
            @if ($notes)
                <div class="notes-label">
                    @lang('pdf_notes')
                </div>

                {!! $notes !!}
            @endif
        </div>
    </div>

    <!-- Review Section -->
    <div class="review-section">
        <div class="review-content">
            <div class="review-text-container">
                <div class="review-text">
                    Vielen Dank für Ihr Vertrauen!<br>
                    Falls Ihnen unser Service gefallen hat, würden wir uns über eine <a href="https://g.page/r/CVYPz75NFIWeEAE/review" class="review-link">Bewertung bei Google</a> freuen.
                </div>
            </div>
            @php
                $qrCodePath = storage_path('app/templates/pdf/invoice/qr-code.png');
            @endphp
            @if(file_exists($qrCodePath))
            <div class="review-qr-container">
                <img src="{{ \App\Space\ImageUtils::toBase64Src($qrCodePath) }}" alt="QR Code für Google Bewertung" class="review-qr-code">
            </div>
            @endif
        </div>
    </div>

    <!-- Footer with Banking Information -->
    <div class="footer">
        <div class="footer-content">
            <div class="footer-left">
                @if ($invoice->company->iban || $invoice->company->bic)
                    @if ($invoice->company->iban)
                        <div class="footer-banking">
                            <span class="banking-label">IBAN:</span><span class="banking-info">{{ $invoice->company->iban }}</span>
                        </div>
                    @endif
                    @if ($invoice->company->bic)
                        <div class="footer-banking">
                            <span class="banking-label">BIC:</span><span class="banking-info">{{ $invoice->company->bic }}</span>
                        </div>
                    @endif
                @endif
            </div>
            <div class="footer-middle">
                <div class="footer-company-name">
                    {{ $invoice->company->name }}
                </div>
                @if ($invoice->company->address)
                    @if ($invoice->company->address->address_street_1)
                        <div class="footer-address">{{ $invoice->company->address->address_street_1 }}</div>
                    @endif
                    @if ($invoice->company->address->city || $invoice->company->address->zip)
                        <div class="footer-address">
                            @if ($invoice->company->address->zip){{ $invoice->company->address->zip }} @endif
                            @if ($invoice->company->address->city){{ $invoice->company->address->city }}@endif
                        </div>
                    @endif
                @endif
            </div>
            <div class="footer-right">
                @if ($invoice->company->address && $invoice->company->address->phone)
                    <div class="footer-contact">Tel: {{ $invoice->company->address->phone }}</div>
                @endif
                @if ($invoice->company->owner && $invoice->company->owner->email)
                    <div class="footer-contact">E-Mail: {{ $invoice->company->owner->email }}</div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>

