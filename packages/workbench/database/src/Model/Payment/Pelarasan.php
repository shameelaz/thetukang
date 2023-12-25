<?php

namespace Workbench\Database\Model\Payment;

use Illuminate\Database\Eloquent\Model;

class Pelarasan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pelarasan';


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




}
