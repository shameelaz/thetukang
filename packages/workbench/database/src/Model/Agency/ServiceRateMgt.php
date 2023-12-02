<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class ServiceRateMgt extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_rate_mgt';

    public function agency()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','fk_agency');
    }

    public function ptj()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Ptj','fk_ptj');
    }

    public function lkpperkhidmatan()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpPerkhidmatan','fk_lkp_perkhidmatan');
    }

    public function kodhasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }

    public function servicerate()
    {
        return $this->hasMany('Workbench\Database\Model\Agency\ServiceRate','service_rate_mgt');
    }


}
