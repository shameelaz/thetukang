<?php

namespace Workbench\Site\Http\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class SampleMailer extends Notification implements ShouldQueue
{
    use Queueable;

    protected  $view = 'site::emails.layouts.simple';
    public  $message;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message , $view = FALSE)
    {
        $this->message = $message;
        $this->view = ($view) ? $view : $this->view;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $mailMessage = new MailMessage;

        if($this->view) $mailMessage->view = $this->view;

        $mailMessage->subject($this->message->get('title', 'Email From ' ));
        // $mailMessage->title($this->message->get('title', 'Email From ' ));
        $mailMessage->level($this->message->get('level'));
        $mailMessage->greeting('Hi,' . ' ' .$notifiable->name. ', ');


        $attachmens = $this->message->get('attach');

        if($attachmens == []){


        }else{


            $mailMessage->attachData($attachmens['ics'], 'invite.ics', [
                    'mime' => 'text/calendar;charset=UTF-8;method=REQUEST\nContent-Transfer-Encoding: 8bit;',
                ]);



        }




        $content  = $this->message->get('content',[]);


        foreach($content as $cont){
            $mailMessage->line($cont);
        }

        $action = $this->message->get('action', FALSE);

        if($action):
        foreach($action as $title => $uri){
            $mailMessage->action($title,$uri);
        }
        endif;


        $footer  = $this->message->get('footer',[]);
        foreach($footer as $foot){
            $mailMessage->line($foot);
        }


        $mailMessage->bcc(env('EMAIL_CC'));
        $mailMessage->cc('elatihan.ppj@outlook.com');

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        
    }
}
