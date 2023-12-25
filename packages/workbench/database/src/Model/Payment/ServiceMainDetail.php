<?php

namespace Workbench\Database\Model\Payment;

use Illuminate\Database\Eloquent\Model;

class ServiceMainDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_main_detail';

    public function category()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\ServiceRate','fk_category');
    }

    public function tetapan()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Tetapan','fk_category');
    }


}
