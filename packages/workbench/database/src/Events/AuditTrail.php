<?php
namespace Workbench\Database\Events;


use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Workbench\Database\Model\Log\LogResetPassword as Log;
use Workbench\Database\Model\Audit\AuditTrail as Trail;
use Auth;

class AuditTrail
{

	/**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userid=NULL,$content=NULL)
    {
        // $this->email = $email;
        // $this->name = $name;
        $this->userid = $userid;
        $this->content = $this->AuditLog($userid,$content);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function AuditLog($userid,$content)
    {
    	$save = new Trail;
    	$save->userid = $userid;
    	$save->desc = $content;
    	$save->save();

    }


}
