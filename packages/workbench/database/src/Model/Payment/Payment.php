<?php

namespace Workbench\Database\Model\Payment;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment';

    public function fkpaymentgateway()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\PaymentGateway','fk_payment_gateway');
    }

    public function fkuser()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }

    public function paymentdetail()
    {
        return $this->hasMany('Workbench\Database\Model\Payment\PaymentDetail','fk_payment');
    }


}
