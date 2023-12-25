<?php

namespace Workbench\Database\Model\Payment;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_detail';

    public function fkpayment()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\Payment','fk_payment');
    }

    public function fkpaymentgateway()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\PaymentGateway','fk_payment_gateway');
    }

    public function fkpayer()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\Payer','fk_payer');
    }

    public function fkkodhasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }

    public function fkperkhidmatan()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpPerkhidmatan','fk_lkp_perkhidmatan');
    }

    public function fktroli()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\Troli','fk_troli');
    }

    public function fkpenyatapemungutdetail()
    {
        return $this->hasMany('Workbench\Database\Model\Payment\PenyataPemungutDetail','fk_payment_detail');
    }



}
