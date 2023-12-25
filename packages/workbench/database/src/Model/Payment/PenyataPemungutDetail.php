<?php

namespace Workbench\Database\Model\Payment;

use Illuminate\Database\Eloquent\Model;

class PenyataPemungutDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'penyata_pemungut_detail';

    public function penyatapemungutmain()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\PenyataPemungutMain','fk_penyata_pemungut');
    }

    public function payment()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\Payment','fk_payment');
    }

    public function paymentdetail()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\PaymentDetail','fk_payment_detail');
    }



}
