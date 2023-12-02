<?php

namespace Workbench\Database\Model\Bill;

use Illuminate\Database\Eloquent\Model;

class PayerAccount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payer_account';

    public function state()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpState','fk_state');
    }

    public function fkagency()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','fk_agency');
    }

    public function fkptj()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Ptj','fk_ptj');
    }

    public function codehasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }

    public function fkpayerbill()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\PayerBill','id');
    }

    public function fkfavouriteaccount()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\FavouriteAccount','id','fk_payer_account');
    }




}
