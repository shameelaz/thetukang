<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class ServiceRate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_rate';

    public function serviceratemgt()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\ServiceRateMgt','service_rate_mgt','id');
    }

    public function fkcategory()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Tetapan','category','id');
    }

    public function fkunit()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Tetapan','unit','id');
    }

}
