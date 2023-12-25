<?php

namespace Workbench\Database\Model\Lkp;

use Illuminate\Database\Eloquent\Model;

class LkpMaster extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lkp_master';

    public function type()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpMasterType','fk_lkp_master_type');
    }




}
