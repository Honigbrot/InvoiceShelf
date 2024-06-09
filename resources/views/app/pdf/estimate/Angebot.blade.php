<!DOCTYPE html>
<html>
<head>
    <title>@lang('pdf_estimate_label') - {{ $estimate->estimate_number }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css">
        /* -- Base -- */
        body {
            font-family: "DejaVu Sans";
        }

        html {
            margin: 0px;
            padding: 0px;
            margin-top: 50px;
        }

        table {
            border-collapse: collapse;
        }

        hr {
            color: rgba(0, 0, 0, 0.2);
            border: 0.5px solid #EAF1FB;
        }

        /* -- Header -- */

        .header-container {
            margin-top: -30px;
            width: 100%;
            padding: 0px 30px;
        }

        .header-logo {

            text-transform: capitalize;
            color: #817AE3;
            padding-top: 0px;
        }

        /* -- Company Address -- */

        .company-address-container {
            width: 50%;
            text-transform: capitalize;
            padding-right: 60px;
            margin-bottom: 2px;

        }

        .company-address {
            margin-top: 12px;
            font-size: 12px;
            line-height: 15px;
            color: #595959;
            word-wrap: break-word;
        }

        /* -- Content Wrapper -- */

        .wrapper {
            display: block;
            padding-top: 0px;
            padding-bottom: 20px;
        }

        .customer-address-container {
            display: block;
            float: left;
            width: 45%;
            padding: 10px 0 0 30px;
        }

        /* -- Shipping -- */

        .shipping-address-container {
            float: right;
            display: block;
        }

        .shipping-address-container--left {
            float: left;
            display: block;
            padding-left: 0;
        }

        .shipping-address-label {
            padding-top: 5px;
            font-size: 12px;
            line-height: 18px;
            margin-bottom: 0px;
        }

        .shipping-address-name {
            padding: 0px;
            font-size: 15px;
            line-height: 22px;
            margin: 0px;
            max-width: 160px;
        }

        .shipping-address {
            font-size: 10px;
            line-height: 15px;
            color: #595959;
            margin-top: 5px;
            width: 160px;
            word-wrap: break-word;
        }

        /* -- Billing -- */

        .billing-address-container {
            display: block;
            float: left;
        }

        .billing-address-label {
            padding-top: 5px;
            font-size: 12px;
            line-height: 18px;
            margin-bottom: 0px;
        }

        .billing-address-name {
            padding: 0px;
            font-size: 15px;
            line-height: 22px;
            margin: 0px;
            max-width: 160px;
        }

        .billing-address {
            font-size: 10px;
            line-height: 15px;
            color: #595959;
            margin-top: 5px;
            width: 160px;
            word-wrap: break-word;
        }

        /* -- Headline -- */

        .headline-container {
            display: block;
            float: left;
        }

        .headline {
            font-size: 18px;
            line-height: 15px;
            color: black;
            margin-top: 10px;
        }

        /* -- Estimate Details -- */

        .estimate-details-container {
            display: block;
            float: right;
            padding: 10px 30px 0 0;
        }

        .attribute-label {
            font-size: 12px;
            line-height: 18px;
            text-align: left;
            color: #55547A
        }

        .attribute-value {
            font-size: 12px;
            line-height: 18px;
            text-align: right;
        }

        /* -- Items Table -- */

        .items-table {
            padding: 30px 30px 10px 30px;
            page-break-before: avoid;
            page-break-after: auto;
        }

        .items-table hr {
            height: 0.1px;
            margin: 0 30px;
        }

        .item-table-heading {
            font-size: 13.5;
            text-align: center;
            color: rgba(0, 0, 0, 0.85);
            padding: 5px;
            padding-bottom: 10px;
        }

        tr.item-table-heading-row th {
            border-bottom: 0.620315px solid #E8E8E8;
            font-size: 12px;
            line-height: 18px;
        }

        .item-table-heading-row {
            margin-bottom: 10px;
        }

        tr.item-row td {
            font-size: 12px;
            line-height: 18px;
        }

        .item-cell {
            font-size: 13;
            color: #040405;
            text-align: center;
            padding: 5px;
            padding-top: 10px;
            border-color: #d9d9d9;
        }

        .item-description {
            color: #595959;
            font-size: 9px;
            line-height: 12px;
        }

        .item-cell-table-hr {
            margin: 0 30px 0 30px;
        }

        /* -- Total Display Table -- */

        .total-display-container {
            padding: 0 25px;
        }

        .total-display-table {
            box-sizing: border-box;
            page-break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
            margin-top: 20px;
            float: right;
            width: auto;

        }

        .total-table-attribute-label {
            font-size: 12px;
            color: #55547A;
            text-align: left;
            padding-left: 10px;
        }

        .total-table-attribute-value {
            font-weight: bold;
            text-align: right;
            font-size: 12px;
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

        .intro-notes {
            margin: 20px 50px;
            text-align: left;
        }

        .notes {
            font-size: 11px;
            color: #595959;
            margin: 50px;
            text-align: left;
        }

        .modular-notes {
            font-size: 11px;
            color: #595959;
            margin: 50px;
            text-align: left;
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

        .text-center {
            text-align: center
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

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
        }

        .footer-wrapper {
            padding: 0 30px;
            margin-top: 30px;
        }

        .footer-wrapper .footer-label {
            display: inline-block;
            width: 60px;
            line-height: 14px;
            height: 14px;
        }

        .footer-table {
            border-top: 0.620315px solid #E8E8E8;
            color: #595959;
            font-size: 10px;
            line-height: 14px;
        }

        .footer-table a {
            color: #595959;
            text-decoration: none;
        }

        .partials {
            margin-bottom: 30px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
<div class="header-container">
    <table width="100%">
        <tr>
            <td width="50%" class="header-section-left">
                @if ($logo)
                    <img class="header-logo" style="height: 50px;" src="{{ $logo }}" alt="Company Logo">
                @else
                    <h1 class="header-logo"> {{ $estimate->customer->company->name }} </h1>
                @endif
            </td>
            <td width="50%" class="text-right company-address-container company-address">
                {!! $company_address !!}
            </td>
        </tr>
    </table>
</div>

<hr class="header-bottom-divider">

<div class="wrapper">
    <div class="main-content">
        <div class="customer-address-container">
            <div class="billing-address-container billing-address">
                @if ($billing_address)
                    <b>@lang('pdf_bill_to')</b> <br>
                    {!! $billing_address !!}
                @endif
            </div>

            <div @if ($estimate->customer->billingaddress) class="shipping-address-container shipping-address"
                 @else class="shipping-address-container--left shipping-address" @endif>
                @if ($shipping_address)
                    <b>@lang('pdf_ship_to')</b> <br>
                    {!! $shipping_address !!}
                @endif
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="estimate-details-container">
            <table>
                <tr>
                    <td class="attribute-label">@lang('pdf_estimate_number')</td>
                    <td class="attribute-value"> &nbsp;{{ $estimate->estimate_number }}</td>
                </tr>
                <tr>
                    <td class="attribute-label">@lang('pdf_estimate_date') </td>
                    <td class="attribute-value"> &nbsp;{{ $estimate->formattedEstimateDate }}</td>
                </tr>
                <tr>
                    <td class="attribute-label">@lang('pdf_estimate_expire_date')</td>
                    <td class="attribute-value"> &nbsp;{{ $estimate->formattedExpiryDate }}</td>
                </tr>
            </table>

        </div>
        <div style="clear: both;"></div>

        <div class="intro-notes">
            @if($estimate->getFormattedString('{CUSTOM_ESTIMATE_ANGEBOTSTITEL}'))
                <div class="headline-container headline">
                    {{ $estimate->getFormattedString('{CUSTOM_ESTIMATE_ANGEBOTSTITEL}') }}
                </div>
            @endif

            @if ($estimate->getFormattedString('{CUSTOM_ESTIMATE_ANGEBOTSBESCHREIBUNG}'))
                <div class="notes-label">
                    Projektvision
                </div>
                    {!! $estimate->getFormattedString('{CUSTOM_ESTIMATE_ANGEBOTSBESCHREIBUNG}') !!}
            @endif

        </div>
        <div style="clear: both;"></div>


        <div>
            @include('app.pdf.estimate.partials.table')
        </div>

        <div class="notes">
            @if ($notes)
                <div class="notes-label">
                    @lang('pdf_notes')
                </div>
                {!! $notes !!}
            @endif
        </div>
        <div class="page-break"></div>
        <div class="modular-notes">

            {{-- Nicht inkludierte Leistungen --}}
            @if($estimate->getFormattedString('{CUSTOM_ESTIMATE_NICHT_INKLUDIERTE_LEISTUNGEN}'))
                <h3>Leistungen, die nicht im Angebot enthalten sind</h3>
                <p>
                    {!! $estimate->getFormattedString('{CUSTOM_ESTIMATE_NICHT_INKLUDIERTE_LEISTUNGEN}') !!}
                </p>
            @endif

            {{-- Content-Erstellung --}}
            @if ($contentCreation = $estimate->getFormattedString('{CUSTOM_ESTIMATE_CONTENT_CREATION}'))
                <h3>Content-Erstellung</h3>
                @if ($contentCreation == 'Customer')
                    <p><strong>Inhaltsbefüllung durch den Auftraggeber:</strong> Die Erstellung und Bereitstellung
                        des
                        Inhalts erfolgt durch den Auftraggeber. Diese Option setzt voraus, dass der bereitgestellte
                        Content den technischen Spezifikationen entspricht und termingerecht übergeben wird.</p>
                @elseif ($contentCreation == 'Ruckzack')
                    <p><strong>Inhaltsbefüllung durch Ruckzack:</strong> Die vollständige Erstellung des Inhalts
                        wird
                        von Ruckzack übernommen. Die Dienstleistung umfasst Kreativität, fachgerechte Ausführung und
                        pünktliche Lieferung des Contents.</p>
                @endif
            @endif

            {{-- Zahlungsbedingungen und -modalitäten --}}
            @if($paymentMode = $estimate->getFormattedString('{CUSTOM_ESTIMATE_ZAHLUNGSMODALITATEN}'))
                <h3>Zahlungsoptionen</h3>
                @if ($paymentMode == 'Abschluss')
                    <p><strong>Zahlung nach Projektabschluss:</strong> Die vollständige Zahlung des vereinbarten
                        Betrags
                        ist innerhalb von 30 Tagen nach der offiziellen Übergabe und Abnahme des Projekts fällig.
                    </p>
                @elseif ($paymentMode == 'Anzahlung+Abschluss')
                    <p><strong>Anzahlung + Schlusszahlung:</strong> 50% des Gesamtbetrags sind als Anzahlung vor
                        Beginn
                        des Projekts zu leisten. Die verbleibende Zahlung von 50% wird nach vollständiger Erbringung
                        der
                        Dienstleistung und zur Ihrer vollsten Zufriedenheit fällig.</p>
                @elseif ($paymentMode == 'Meilensteine')
                    <p><strong>Zahlung nach Meilensteinen:</strong> Die Gesamtzahlung wird in folgende Teile
                        gegliedert:
                        30% Anzahlung bei Projektstart, 30% nach Fertigstellung des Designs, und 40% nach
                        vollständiger
                        Implementierung der Softwarelösung.</p>
                @endif

            @endif

            {{-- Änderungsmanagement und Scope Creep --}}
            @if($estimate->getFormattedString('{CUSTOM_ESTIMATE_SCOPE_CREEP}'))
                <h3>Änderungsmanagement und Scope Creep</h3>
                <p>
                    <strong>Änderungsanforderungen:</strong> Alle Änderungen an den Anforderungen müssen schriftlich
                    beantragt und von beiden Parteien genehmigt werden.
                </p>
                <p>
                    <strong>Scope Creep:</strong> Zusätzliche Funktionen oder Änderungen, die nicht im
                    ursprünglichen
                    Anforderungskatalog enthalten sind, werden gesondert in Rechnung gestellt.
                </p>
            @endif

            {{-- DSGVO-Konformität und Datenschutzmaßnahmen --}}
            @if($estimate->getFormattedString('{CUSTOM_ESTIMATE_DSGVO}'))
                <h3>DSGVO-Konformität und Datenschutzmaßnahmen</h3>
                <p>In der Umsetzung des Projekts achten wir sorgfältig darauf, die Datenschutzvorschriften gemäß der
                    EU-Datenschutz-Grundverordnung (DSGVO) einzuhalten. Zu den technischen und organisatorischen
                    Maßnahmen
                    gehören:</p>
                <ul>
                    <li><strong>Verschlüsselung:</strong> Alle personenbezogenen Daten werden bei der Übertragung und
                        Speicherung
                        verschlüsselt, um die Sicherheit und Vertraulichkeit zu gewährleisten.
                    </li>
                    <li><strong>Speicherung und automatische Löschung:</strong> Daten in Serverlog-Files sowie Daten,
                        die
                        über
                        Formulare erfasst werden, werden nur so lange wie notwendig gespeichert und danach automatisch
                        gelöscht,
                        um Compliance mit datenschutzrechtlichen Bestimmungen zu gewährleisten.
                    </li>
                    <li><strong>Inhaltliche Ausgestaltung:</strong> Die rechtliche und inhaltliche Ausgestaltung von
                        Impressum,
                        Datenschutzhinweis und Cookie Consent obliegt dem Herausgeber bzw. Auftraggeber. Wir sorgen für
                        die
                        technische Implementierung dieser Elemente gemäß den Vorgaben des Auftraggebers.
                    </li>
                </ul>
                <p>Es ist zu beachten, dass unser Angebot keine Rechtsberatung oder rechtliche Prüfung der Inhalte
                    umfasst.
                    Für die rechtliche Konformität der inhaltlichen Gestaltung ist der Auftraggeber
                    verantwortlich.</p>
            @endif

            {{-- Schlussbestimmungen --}}
            @if($estimate->getFormattedString('{CUSTOM_ESTIMATE_SCHLUSSBESTIMMUNGEN}'))
                <h3>Schlussbestimmungen</h3>
            <ul>
                <li><strong>Vertraulichkeit:</strong> Beide Parteien verpflichten sich zur Vertraulichkeit aller
                    Projektdetails.</li>
                <li><strong>Haftung:</strong> Die Haftung für Schäden, die durch leichte Fahrlässigkeit verursacht
                    wurden,
                    wird ausgeschlossen.</li>
                <li><strong>Geltendes Recht:</strong> Es gilt österreichisches Recht.</li>
            </ul>
            @endif
        </div>
    </div>
</div>
<footer>
    <div class="footer-wrapper">
        <table width="100%" class="footer-table" cellspacing="0" border="0">
            <tr>
                <td width="33%">
                    <b>Ruckzack OG</b><br>
                    Langfeldstraße 35<br>
                    4040 Plesching
                </td>
                <td width="33%">
                    <a href="mailto:office@ruckzack.at">office@ruckzack.at</a><br>
                    +43 732 261790<br>
                    <a href="https://ruckzack.at/">www.ruckzack.at</a>
                </td>
                <td width="33%">
                    <span class="footer-label">USt-IdNr</span> ATU77089179<br>
                    <span class="footer-label">IBAN</span> AT20 2032 0321 0059 3461<br>
                </td>
            </tr>
        </table>
    </div>
</footer>
</body>
</html>
