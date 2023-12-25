<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class LamanAgensi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'laman_agensi';

    public function agensi()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','fk_agency');
    }

    public function kodhasil()
    {
        return $this->hasMany('Workbench\Database\Model\Agency\KodHasil','fk_agency','id');
    }

    public function lamanagensiperkhidmatan()
    {
        return $this->hasMany('Workbench\Database\Model\Agency\LamanAgensiPerkhidmatan','fk_laman_agensi','id');
    }

    public function perkhidmatandalaman()
    {
        return $this->hasMany('Workbench\Database\Model\Agency\LamanAgensiPerkhidmatanDalaman','fk_laman_agensi','id');
    }


}
