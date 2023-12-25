<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class Ptj extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ptj';

    public function agency()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','fk_agency');
    }

    public function payerAccount()
    {
        return $this->hasMany('Workbench\Database\Model\Bill\PayerAccount','fk_ptj','id');
    }

    public function merchantsetup()
    {
        return $this->hasOne('Workbench\Database\Model\Payment\MerchantSetup','fk_ptj');
    }



}
