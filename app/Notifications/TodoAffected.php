<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TodoAffected extends Notification
{
    use Queueable;
    public $todo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($todo)
    {
        $this->todo = $todo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('noreply@laravel-todo', 'laravel todo')
                    ->subject('tu as une nouvelles todo à finir')
                    ->line("la todo (#". $this->todo->id.")'". $this->todo->name."'vient d'être affecter par".$this->todo->todoAffectedBy->name . ".")
                    ->action('Voir toutes mes todos', url('/todos'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'todo_id' => $this->todo->id,
            'affected_by' => $this->todo->todoAffectedBy->name,
            'todo_name' => $this->todo->name,
        ];
    }
}