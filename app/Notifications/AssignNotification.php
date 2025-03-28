<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignNotification extends Notification implements ShouldQueue
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
            ->subject('You have been assigned a ticket')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have been assigned to a new support ticket.')
            ->action('View Ticket', url(route('ticket.view', $this->ticket->id)))
            ->line('Please review and respond as soon as possible.')
            ->salutation('Xstros Support Team');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'title' => 'You have been assigned a ticket',
            'message' => 'You have been assigned to a new support ticket.',
            'timestamp' => now()->toDateTimeString(),
            'url' => url(route('ticket.view', $this->ticket->id)),

        ];
    }
}
