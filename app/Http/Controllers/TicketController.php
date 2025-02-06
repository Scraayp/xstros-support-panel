<?php

namespace App\Http\Controllers;

use App\Mail\ReplyNotification;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TicketController extends Controller
{

    public function new(): View
    {
        return view('ticket.new');
    }

    public function view(Ticket $ticket): View
    {
        if($ticket->user->id !== Auth::id() && Auth::user()->role !== "Admin" && Auth::user()->role !== "Staff") {
            abort(403);
        }
        return view('ticket.view', [
            'ticket' => $ticket,
        ]);
    }

    public function reply(Request $request, Ticket $ticket): RedirectResponse
    {
        if($ticket->user->id !== Auth::id() && Auth::user()->role !== "Admin" && Auth::user()->role !== "Staff") {
            abort(403);
        }
        // Validate the reply message
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $replyRole = $ticket->user->role;

        if($ticket->user->role === "Admin" || $ticket->user->role === "Staff") {
            $replyRole = "staff";
        }

        // Create the reply
        $reply = Reply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),  // Store the logged-in user's ID
            'message' => $request->input('message'),
            'role' => $replyRole,  // Assuming role is 'user' for the customer replies
        ]);

        // If a staff member replies, set the ticket to awaiting client reply
        if ($ticket->user->role === 'staff' || $ticket->user->role === 'Admin') {
            if($ticket->status === 'open' || $ticket->status === "awaiting_staff_reply") {
                $ticket->update([
                    'status' => 'awaiting_client_reply',
                ]);
            }
        }

        Mail::to($ticket->user->email)->queue(new ReplyNotification($ticket, $reply));

        // Redirect back to the ticket view page
        return redirect()->route('ticket.view', $ticket);
    }

    public function create(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'server_info' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Create the ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),  // Associate the ticket with the authenticated user
            'title' => $validated['title'],
            'description' => $validated['product'] . ' - ' . $validated['server_info'],  // Concatenate product and server info
            'status' => 'open',  // Default status for new tickets
        ]);

        // Create the first reply (message from the user)
        Reply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),  // Associate the reply with the authenticated user
            'message' => $validated['message'],
            'role' => 'user',  // Role is 'user' for the ticket creator
        ]);

        // Redirect to dashboard or ticket view page
        return redirect()->route('dashboard');  // Change this route as needed
    }

    public  function close(Ticket $ticket): RedirectResponse
    {
        if($ticket->user->id !== Auth::id() && Auth::user()->role !== "Admin" && Auth::user()->role !== "Staff") {
            abort(403);
        }
        $ticket->update([
            'status' => 'closed',
        ]);
        return redirect()->route('dashboard');
    }

}
