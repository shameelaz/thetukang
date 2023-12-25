<?php

namespace Workbench\Dashboard\Http\Notifications\Mailable;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// use Orchestra\Contracts\Memory\Provider;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

        // $this->memory = app(Provider::class);

        $mailMessage = new MailMessage;

        $mailMessage->subject(" : Kemaskini Maklumat Akaun Email");
        // $mailMessage->title(" : Kemaskini Maklumat Akaun Email");
        $mailMessage->level('warning'); 
        $mailMessage->greeting('Hi' . ', Tuan / Puan');
        $mailMessage->line('Maklumat Akaun Email Bagi Berikut Perlu Dikemaskini');
        $mailMessage->line('<b>ID Pengguna</b> : ');
        $mailMessage->line('<b>Kata Laluan</b> : ');
        $mailMessage->line('Sila Tukar Katalaluan Anda Kemudian Log Masuk Melalui Pautan Dibawah');
        // $mailMessage->actionText(handles('ecuti::/auth/login'));

        $this->content = $mailMessage->toArray();


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('portaladmin@ppj.gov.my')
                    ->subject(data_get($this->content,'subject'))
                    ->view('ecuti::emails.layouts.simple')
                    ->with($this->content);
    }
}
