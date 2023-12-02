<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class AgService extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agency_service';


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
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpPerkhidmatan','fk_perkhidmatan');
    }

    public function codehasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }





}
