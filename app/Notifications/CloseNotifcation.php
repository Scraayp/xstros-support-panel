<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CloseNotifcation extends Notification implements ShouldQueue
{
    use Queueable;

    public $ticket;
    /**
     * Create a new notification instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
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
            ->subject('Your Ticket Was Closed')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your ticket was closed by the support team.')
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
            'timestamp' => now()->toDateTimeString(),
            'title' => 'Your ticket was closed',
            'message' => 'Your ticket was closed by the support team.'
        ];
    }
}
