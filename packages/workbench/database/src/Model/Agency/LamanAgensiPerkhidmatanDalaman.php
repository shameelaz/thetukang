<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class LamanAgensiPerkhidmatanDalaman extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'laman_agensi_perkhidmatan_dalaman';

    public function lamanagensi()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\LamanAgensi','fk_laman_agensi');
    }

    public function codehasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }

    public function lkpperkhidmatan()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpPerkhidmatan','fk_lkp_perkhidmatan');
    }


}
