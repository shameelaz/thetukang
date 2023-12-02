<?php

namespace Workbench\Database\Model\Payment;

use Illuminate\Database\Eloquent\Model;

class PenyataPemungutMain extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'penyata_pemungut_main';

    public function agency()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','fk_agency');
    }

    public function ptj()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Ptj','fk_ptj');
    }

    public function penyatapemungutdetail()
    {
        return $this->hasMany('Workbench\Database\Model\Payment\PenyataPemungutDetail','fk_penyata_pemungut');
    }

    public function userprofile()
    {
        return $this->hasMany('Workbench\Database\Model\User\UserProfile','fk_ptj');
    }

    public function merchantsetup()
    {
        return $this->hasOne('Workbench\Database\Model\Payment\MerchantSetup','fk_ptj','fk_ptj');
    }


}
