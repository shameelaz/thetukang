<?php

namespace Workbench\Database\Model\Bill;

use Illuminate\Database\Eloquent\Model;

class Troli extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'troli';



    public function fkpayerbill()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\PayerBill','fk_payer_bill');
    }
    public function fkuser()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }

    public function fkservice()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\ServiceMain','fk_service');
    }

    public function fkpayer()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\Payer','fk_payer');
    }








}
