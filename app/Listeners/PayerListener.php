<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use App\Events\InboxNote;
use Workbench\Database\Model\User\Inbox;
use Workbench\Database\Model\User\UserProfile;

class PayerListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(InboxNote $event)
    {
       // dd($event->PayerBill->id);

       //checkuser id if ada using icno
        $id = $event->PayerBill->identification_no;
        $user = UserProfile::where('refid','=',$id)->first();

        if($user)
        {
            $inbox = new Inbox;
           $inbox->fk_payer_bill = $event->PayerBill->id;
           $inbox->kepada = $user->fk_users;
           $inbox->daripada = $event->PayerBill->fk_ptj;
           $inbox->status = 0;
           $inbox->keterangan = 'Terdapat Pembayaran Baru Telah tersedia untuk '.$event->PayerBill->bill_detail.', berjumlah RM '.$event->PayerBill->amount;
           $inbox->save();
        }


       //insert into table inbox
       

    }
}
