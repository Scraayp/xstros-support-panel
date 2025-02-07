<?php
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/checkout', function(Request $request) {
        $stripePriceId = 'price_1QpmtCJWTCq7xH6mldvtI4wM';

        $quantity = 1;

        return Auth::user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('dashboard'),
            'cancel_url' => route('user.list'),
        ]);
    })->name('payment.checkout');
});
