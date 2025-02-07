<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Stripe\Charge;
use Stripe\Invoice;
use Stripe\Stripe;

class InvoiceController extends Controller
{
    public function view(): View
    {
        Stripe::setApiKey(config('cashier.secret'));

        // Retrieve all charges for the authenticated user
        $charges = Charge::all([
            'customer' => Auth::user()->stripe_id,
            'limit' => 100,
        ]);

        // Separate completed & incomplete transactions
        $transactions = collect($charges->data);
        $completedTransactions = $transactions->filter(fn($t) => $t->paid && $t->status === 'succeeded');
        $incompleteTransactions = $transactions->filter(fn($t) => !$t->paid || $t->status !== 'succeeded');

        // Retrieve all invoices for the user (including manual invoices)
        $stripeInvoices = Invoice::all([
            'customer' => Auth::user()->stripe_id,
            'limit' => 100,
        ]);
        $invoices = collect($stripeInvoices->data);


        return view('payments.invoices.list', compact('completedTransactions', 'incompleteTransactions', 'invoices'));
    }
}
