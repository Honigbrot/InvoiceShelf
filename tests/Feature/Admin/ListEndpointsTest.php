<?php

use App\Models\Estimate;
use App\Models\EstimateItem;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\getJson;

beforeEach(function () {
    Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--force' => true]);
    Artisan::call('db:seed', ['--class' => 'DemoSeeder', '--force' => true]);

    $user = User::find(1);
    $this->withHeaders([
        'company' => $user->companies()->first()->id,
    ]);
    Sanctum::actingAs(
        $user,
        ['*']
    );
});

test('invoice list returns the list shape without nested detail relations', function () {
    Invoice::factory()->count(8)->create()->each(function ($invoice) {
        InvoiceItem::factory()->count(3)->create(['invoice_id' => $invoice->id]);
    });

    DB::enableQueryLog();

    $response = getJson('api/v1/invoices?page=1&limit=10')
        ->assertOk()
        ->assertJsonStructure(['data' => [[
            'id', 'invoice_number', 'formatted_invoice_date', 'status', 'paid_status',
            'total', 'due_amount', 'unique_hash', 'allow_edit',
            'customer' => ['name', 'email', 'currency'],
        ]]]);

    expect($response->json('data.0'))->not->toHaveKeys(['items', 'taxes', 'company', 'fields']);
    expect(count(DB::getQueryLog()))->toBeLessThan(80);
});

test('estimate list returns the list shape without nested detail relations', function () {
    Estimate::factory()->count(8)->create()->each(function ($estimate) {
        EstimateItem::factory()->count(3)->create(['estimate_id' => $estimate->id]);
    });

    DB::enableQueryLog();

    $response = getJson('api/v1/estimates?page=1&limit=10')
        ->assertOk()
        ->assertJsonStructure(['data' => [[
            'id', 'estimate_number', 'formatted_estimate_date', 'status', 'total', 'unique_hash',
            'customer' => ['name', 'email', 'currency'],
        ]]]);

    expect($response->json('data.0'))->not->toHaveKeys(['items', 'taxes', 'company', 'fields']);
    expect(count(DB::getQueryLog()))->toBeLessThan(60);
});

test('payment list returns the list shape without nested detail relations', function () {
    Payment::factory()->count(8)->create();

    DB::enableQueryLog();

    $response = getJson('api/v1/payments?page=1&limit=10')
        ->assertOk()
        ->assertJsonStructure(['data' => [[
            'id', 'payment_number', 'formatted_payment_date', 'amount', 'unique_hash',
            'customer' => ['name', 'email', 'currency'],
        ]]]);

    expect($response->json('data.0'))->not->toHaveKeys(['company', 'fields', 'invoice', 'transaction']);
    expect(count(DB::getQueryLog()))->toBeLessThan(60);
});
