<?php
namespace Workbench\Database\Events;


use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Workbench\Database\Model\Log\LogResetPassword as Log;

class LogResetPassword
{

	/**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email=NULL,$name=NULL,$content=NULL)
    {   
        $this->email = $email;
        $this->name = $name;
        $this->content = $this->AuditLogReset($email,$name,$content);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function AuditLogReset($email,$name,$content)
    {
    	$save = new Log;
    	$save->date_email = date('Y-m-d H:i:s');
    	$save->email = $email;
    	$save->name = $name;
        $save->status = 1;
    	$save->save();

    }


}