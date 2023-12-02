<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class MainService extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'main_service';

    public function lkpservicetype()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\LkpServiceType','fk_lkp_service_type');
    }
}
