<?php
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/invoices', [\App\Http\Controllers\InvoiceController::class, 'view'])->name('payments.invoice.list');
});
