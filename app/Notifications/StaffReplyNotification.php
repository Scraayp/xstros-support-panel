<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StaffReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $ticket;
    public $reply;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket, $reply)
    {
        $this->ticket = $ticket;
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Customer Replied to Ticket #' . $this->ticket->id)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A customer has replied to an open ticket.')
            ->line('Customer: ' . $this->reply->user->name)
            ->line('Message: ' . $this->reply->message)
            ->action('View Ticket', url(route('ticket.view', $this->ticket->id)))
            ->line('Please respond as soon as possible.')
            ->salutation('Xstros Support Team');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'reply_id' => $this->reply->id,
            'customer_name' => $this->reply->user->name,
            'customer_message' => $this->reply->message,
            'timestamp' => now()->toDateTimeString(),
            'title' => 'Customer replied to ticket',
            'message' => 'A customer has replied to an open ticket.'
        ];
    }
}
