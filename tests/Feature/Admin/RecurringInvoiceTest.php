<?php

use App\Http\Controllers\V1\Admin\RecurringInvoice\RecurringInvoiceController;
use App\Http\Requests\RecurringInvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\RecurringInvoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

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

test('get recurring invoices', function () {
    RecurringInvoice::factory()->create();

    getJson('api/v1/recurring-invoices?page=1')
        ->assertOk();
});

test('recurring invoice list stays lightweight as generated invoices pile up', function () {
    $recurringInvoices = RecurringInvoice::factory()->count(5)->create();

    foreach ($recurringInvoices as $recurringInvoice) {
        Invoice::factory()->count(3)->create([
            'recurring_invoice_id' => $recurringInvoice->id,
        ]);
    }

    DB::enableQueryLog();

    $response = getJson('api/v1/recurring-invoices?page=1&limit=10')
        ->assertOk()
        ->assertJsonCount(5, 'data')
        ->assertJsonStructure(['data' => [['id', 'status', 'frequency', 'total', 'formatted_starts_at', 'customer' => ['name', 'currency']]]]);

    expect($response->json('data.0'))->not->toHaveKeys(['invoices', 'items', 'taxes']);
    expect(count(DB::getQueryLog()))->toBeLessThan(40);
});

test('store user using a form request', function () {
    $this->assertActionUsesFormRequest(
        RecurringInvoiceController::class,
        'store',
        RecurringInvoiceRequest::class
    );
});

test('store recurring invoice', function () {
    $recurringInvoice = RecurringInvoice::factory()->raw();
    $recurringInvoice['items'] = [
        InvoiceItem::factory()->raw(),
    ];

    postJson('api/v1/recurring-invoices', $recurringInvoice)
        ->assertStatus(201);

    $recurringInvoice = collect($recurringInvoice)
        ->only([
            'frequency',
        ])
        ->toArray();

    $this->assertDatabaseHas('recurring_invoices', $recurringInvoice);
});

test('get recurring invoice', function () {
    $recurringInvoice = RecurringInvoice::factory()->create();

    getJson("api/v1/recurring-invoices/{$recurringInvoice->id}")
        ->assertOk();
});

test('update user using a form request', function () {
    $this->assertActionUsesFormRequest(
        RecurringInvoiceController::class,
        'update',
        RecurringInvoiceRequest::class
    );
});

test('update recurring invoice', function () {
    $recurringInvoice = RecurringInvoice::factory()->create();
    $recurringInvoice['items'] = [
        InvoiceItem::factory()->raw(),
    ];

    $new_recurringInvoice = RecurringInvoice::factory()->raw();
    $new_recurringInvoice['items'] = [
        InvoiceItem::factory()->raw(),
    ];

    putJson("api/v1/recurring-invoices/{$recurringInvoice->id}", $new_recurringInvoice)
        ->assertOk();

    $new_recurringInvoice = collect($new_recurringInvoice)
        ->only([
            'frequency',
        ])
        ->toArray();

    $this->assertDatabaseHas('recurring_invoices', $new_recurringInvoice);
});

test('delete multiple recurring invoice', function () {
    $recurringInvoices = RecurringInvoice::factory()->count(3)->create();

    $data = [
        'ids' => $recurringInvoices->pluck('id'),
    ];

    postJson('api/v1/recurring-invoices/delete', $data)
        ->assertOk()
        ->assertJson([
            'success' => true,
        ]);

    foreach ($recurringInvoices as $recurringInvoice) {
        $this->assertModelMissing($recurringInvoice);
    }
});

test('calculate frequency for recurring invoice', function () {
    $data = [
        'frequency' => '* * 2 * *',
        'starts_at' => Carbon::now()->format('Y-m-d'),
    ];

    $queryString = http_build_query($data, '', '&');

    getJson('api/v1/recurring-invoice-frequency?'.$queryString)
        ->assertOk();
});
