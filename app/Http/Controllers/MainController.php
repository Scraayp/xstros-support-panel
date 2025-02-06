<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\View\View;

class MainController extends Controller
{

    public function view(): View
    {
        if(\Auth::user()->role === 'Admin' || \Auth::user()->role === 'Staff'){
            return view('dashboard', ['tickets' => Ticket::all()]);
        }else
        {
            $tickets = Ticket::where('user_id', auth()->id())->get();
            return view('dashboard', ['tickets' => $tickets]);
        }
    }

}
