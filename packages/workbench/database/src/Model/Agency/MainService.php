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
    public function user()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }
    public function promotion()
    {
        return $this->hasMany('Workbench\Database\Model\Agency\MainPromotion','fk_main_service');
    }
}
