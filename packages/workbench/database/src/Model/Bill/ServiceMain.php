<?php

namespace Workbench\Database\Model\Bill;

use Illuminate\Database\Eloquent\Model;

class ServiceMain extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_main';

    public function fkuser()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }

    public function fkkodhasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }

    public function servicemaindetail()
    {
        return $this->hasMany('Workbench\Database\Model\Bill\ServiceMainDetail','fk_service_main','id');
    }

    public function fkpayer()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\Payer','fk_payer');
    }

    public function serviceratemgt()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\ServiceRateMgt', 'fk_service_rate_mgt', 'id');
    }

    public function fkpaymentgateway()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\PaymentGateway','fk_payment_gateway');
    }








}
