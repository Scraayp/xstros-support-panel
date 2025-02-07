<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Stripe\Charge;
use Stripe\Stripe;

class MainController extends Controller
{

    public function view(): View
    {
        Stripe::setApiKey(config('cashier.secret'));

        $openTickets = 0;
        $closedTickets = 0;

        if(\Auth::user()->role === 'Admin' || \Auth::user()->role === 'Staff') {
            $openTickets = Ticket::whereIn('status', ['open', 'awaiting_client_reply', 'awaiting_staff_reply'])->count();
            $closedTickets = Ticket::where('status', 'closed')->count();
        }else {
            $openTickets = Ticket::where('status', ['open', 'awaiting_client_reply', 'awaiting_staff_reply'])->where('user_id', auth()->id())->count();
            $closedTickets = Ticket::where('status', 'closed')->where('user_id', auth()->id())->count();
        }

        if (\Auth::user()->role === 'Admin') {
            $charges = Charge::all();

            // Separate completed & incomplete transactions
            $transactions = collect($charges->data);

            $completedTransactions = $transactions->filter(fn($t) => $t->paid && $t->status === 'succeeded');
            $incompleteTransactions = $transactions->filter(fn($t) => !$t->paid || $t->status !== 'succeeded');
        } else {
            $charges = Charge::all([
                'customer' => Auth::user()->stripe_id,
            ]);

            // Separate completed & incomplete transactions
            $transactions = collect($charges->data);
            $completedTransactions = $transactions->filter(fn($t) => $t->paid && $t->status === 'succeeded');
            $incompleteTransactions = $transactions->filter(fn($t) => !$t->paid || $t->status !== 'succeeded');
        }

        return view('dashboard', ['openTickets' => $openTickets, 'closedTickets' => $closedTickets, 'completedTransactions' => $completedTransactions->count(), 'incompleteTransactions' => $incompleteTransactions->count(), 'completedTransactionsMoney' => $completedTransactions->sum(function ($transaction) {
            return $transaction['amount'] / 100;
        })]);
    }

}
