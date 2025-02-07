<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyNotification extends Notification implements ShouldQueue
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Reply to Your Ticket')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('There was a new reply to your ticket.')
            ->line('Sent by: ' . $this->reply->user->name . " (" . $this->reply->user->role . ")")
            ->line('Message: ' . $this->reply->message)
            ->action('View Ticket', url(route('ticket.view', $this->ticket->id)))
            ->line('Thank you for using our support system!')
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
            'reply_creator' => $this->reply->user->name,
            'reply_creator_role' => $this->reply->user->role,
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}
