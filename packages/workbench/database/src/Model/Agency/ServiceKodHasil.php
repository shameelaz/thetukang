<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class ServiceKodHasil extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_kod_hasil';

    public function lkpperkhidmatan()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpPerkhidmatan','fk_lkp_perkhidmatan');
    }

    public function hasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_lkp_perkhidmatan');
    }
    public function detail()
    {
        return $this->hasMany('Workbench\Database\Model\Agency\ServiceKodHasilDetail','fk_service_kod_hasil');
    }



}
