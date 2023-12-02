<?php

namespace Workbench\Dashboard\Http\Notifications\Mailable;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class Welcome extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        // The $notifiable is already a User instance so not really necessary to pass it here
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->greeting('Bonjour '.$this->user->name)
            ->line('Nous vous remercions de votre inscription.')
            ->line('Pour rappel voici vos informations :')
            ->line('Mail: '.$this->user->email)
            ->line('Password: '.$this->user->password);
    }

}