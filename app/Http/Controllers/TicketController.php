<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyCreateRequest;
use App\Http\Requests\TicketCreateRequest;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\AssignNotification;
use App\Notifications\CloseNotifcation;
use App\Notifications\OpenNotification;
use App\Notifications\ReplyNotification;
use App\Notifications\StaffReplyNotification;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{

    public function new(): View
    {
        return view('ticket.new');
    }

    public function list(): View
    {
        if(\Auth::user()->role === 'Admin' || \Auth::user()->role === 'Staff'){
            $ticketStats = [
                'open' => Ticket::whereIn('status', ['open', 'awaiting_client_reply', 'awaiting_staff_reply'])->count(),
                'closed' => Ticket::where('status', 'closed')->count(),
                'in_progress' => Ticket::where('status', 'in_progress')->count(),
                'awaiting' => Ticket::where('status', 'awaiting_staff_reply')->count(),
                'total' => Ticket::count(),
            ];
            return view('ticket.list', ['tickets' => Ticket::all(), 'ticketStats' => $ticketStats]);
        }else
        {
            $tickets = Ticket::where('user_id', auth()->id())->get();
            $ticketStats = [
                'open' => Ticket::whereIn('status', ['open', 'awaiting_client_reply', 'awaiting_staff_reply'])->where('user_id', Auth::id())->count(),
                'closed' => Ticket::where('status', 'closed')->where('user_id', Auth::id())->count(),
                'in_progress' => Ticket::where('status', 'in_progress')->where('user_id', Auth::id())->count(),
                'awaiting' => Ticket::where('status', 'awaiting_client_reply')->where('user_id', Auth::id())->count(),
                'total' => Ticket::where('user_id', Auth::id())->count(),
            ];
            return view('ticket.list', ['tickets' => $tickets, 'ticketStats' => $ticketStats]);
        }
    }

    public function view(Ticket $ticket): View
    {
        $staffMembers = User::whereIn('role', ['Staff', 'Admin'])->get();
        if($ticket->user->id !== Auth::id() && Auth::user()->role !== "Admin" && Auth::user()->role !== "Staff") {
            abort(403);
        }
        return view('ticket.view', [
            'ticket' => $ticket,
            'staffMembers' => $staffMembers
        ]);
    }

    public function reply(ReplyCreateRequest $request, Ticket $ticket): RedirectResponse
    {
        if($ticket->user->id !== Auth::id() && Auth::user()->role !== "Admin" && Auth::user()->role !== "Staff") {
            abort(403);
        }
        // Validate the reply message
        $request->validated();

        $replyRole = Auth::user()->role;

        $roleForReply = in_array($replyRole, ['Admin', 'Staff']) ? 'staff' : 'user';

        // Create the reply
        $reply = Reply::create([
            'ticket_id' => $ticket->id,
            'user_id'   => Auth::id(),
            'message'   => $request->input('message'),
            'role'      => $roleForReply,
        ]);

        // If a staff member replies, set the ticket to awaiting client reply
        if ($replyRole === "Admin" || $replyRole === "Staff") {
          $ticket->update([
            'status' => 'awaiting_client_reply',
          ]);
          $ticket->save();
        }else {
            $staffMembers = User::whereIn('role', ['Staff', 'Admin'])->get();

            foreach ($staffMembers as $staff) {
                $staff->notify(new StaffReplyNotification($ticket, $reply));
            }
          $ticket->update([
            'status' => 'awaiting_staff_reply',
          ]);
          $ticket->save();
        }

        if($ticket->user->id !== $reply->user->id) {
            $ticket->user->notify(new ReplyNotification($ticket, $reply));
       }

        // Redirect back to the ticket view page
        return redirect()->route('ticket.view', $ticket)->with('status', 'reply-created');
    }

    public function create(TicketCreateRequest $request): RedirectResponse
    {
        // Validate the incoming request data
        $validated = $request->validated();

        // Create the ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),  // Associate the ticket with the authenticated user
            'title' => $validated['title'],
            'description' => $validated['product'] . ' - ' . $validated['server_info'],  // Concatenate product and server info
            'status' => 'open',  // Default status for new tickets,
            'priority' => 'low',
        ]);

        // Create the first reply (message from the user)
        Reply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),  // Associate the reply with the authenticated user
            'message' => $validated['message'],
            'role' => 'user',  // Role is 'user' for the ticket creator
        ]);

        $staffMembers = User::whereIn('role', ['Staff', 'Admin'])->get();

        foreach ($staffMembers as $staff) {
            $staff->notify(new OpenNotification($ticket));
        }

        // Redirect to dashboard or ticket view page
        return redirect()->route('ticket.view', $ticket)->with('status', 'ticket-created');  // Change this route as needed
    }

    public  function close(Ticket $ticket): RedirectResponse
    {
        if($ticket->user->id !== Auth::id() && Auth::user()->role !== "Admin" && Auth::user()->role !== "Staff") {
            abort(403);
        }
        $ticket->update([
            'status' => 'closed',
            'closed_at' => Carbon::now(),
            'closer_id' => Auth::id(),
        ]);

        $ticket->user->notify(new CloseNotifcation($ticket));

        return redirect()->route('ticket.list')->with('status', 'ticket-closed');
    }

    public function assignStaff(Request $request, Ticket $ticket)
    {
        $ticket->update(['assigned_to' => $request->assigned_to]);
        $ticket->save();

        $staffMember = User::find($request->assigned_to);
        $staffMember->notify(new AssignNotification($ticket));

        return redirect()->route('ticket.view', $ticket)->with('status', 'ticket-assigned');
    }

    public function reopen(Request $request, Ticket $ticket)
    {
        if($ticket->user->id !== Auth::id() && Auth::user()->role !== "Admin" && Auth::user()->role !== "Staff") {
            abort(403);
        }
        $ticket->update([
            'status' => 'open',
            'closed_at' => null,
            'closer_id' => null,
        ]);

        $ticket->user->notify(new OpenNotification($ticket));

        return redirect()->route('ticket.view', $ticket)->with('status', 'ticket-reopened');
    }
}
