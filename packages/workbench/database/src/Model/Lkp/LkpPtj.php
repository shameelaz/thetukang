<?php

namespace Workbench\Database\Model\Lkp;

use Illuminate\Database\Eloquent\Model;

class LkpPtj extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lkp_ptj';

    public function agency()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','fk_agency');
    }


}
