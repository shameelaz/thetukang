<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class KodHasil extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kod_hasil';


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
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpPerkhidmatan', 'fk_perkhidmatan');
    }

    public function lkpkodhasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpKodHasil','fk_lkp_kod_hasil');
    }







}
