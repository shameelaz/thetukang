<?php

namespace Workbench\Database\Model\Bill;

use Illuminate\Database\Eloquent\Model;
use App\Events\InboxNote;

class PayerBill extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payer_bill';
    protected $dispatchesEvents = [

        'created' => InboxNote::class,
    ];

    public function payeraccount()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\PayerAccount','fk_payer_account');
    }

    public function fkkodhasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }

    public function fkptj()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Ptj','fk_ptj');
    }






}
