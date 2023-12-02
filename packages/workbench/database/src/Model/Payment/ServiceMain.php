<?php

namespace Workbench\Database\Model\Payment;

use Illuminate\Database\Eloquent\Model;

class ServiceMain extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_main';


    public function srvmaindetail()
    {
        return $this->hasMany('Workbench\Database\Model\Payment\ServiceMainDetail','fk_service_main','id');
    }

    public function srvmainmgt()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\ServiceRateMgt','fk_service_rate_mgt');
    }

    public function codehasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }

    public function fkpaymentgateway()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\PaymentGateway','fk_payment_gateway');
    }

    public function fkpayer()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\Payer','fk_payer');
    }

    public function fkpayerbill()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\PayerBill','fk_payer_bill');
    }


}
