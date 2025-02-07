<?php
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/checkout', function(Request $request) {
        $stripePriceId = 'price_1QpmtCJWTCq7xH6mldvtI4wM';

        $quantity = 1;

        return Auth::user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('payments.invoice.list'),
            'cancel_url' => route('payments.invoice.list'),
        ]);
    })->name('payment.checkout');
});
