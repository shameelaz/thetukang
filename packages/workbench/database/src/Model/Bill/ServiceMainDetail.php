<?php

namespace Workbench\Database\Model\Bill;

use Illuminate\Database\Eloquent\Model;

class ServiceMainDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_main_detail';

    public function fkuser()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }

    public function fkkodhasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }

    public function servicemaindetail()
    {
        return $this->hasMany('Workbench\Database\Model\Bill\ServiceMainDetail','id','fk_service_main');
    }

    public function category()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\ServiceRate','fk_category');
    }

    // public function fkserviceratemgt()
    // {
    //     return $this->belongsTo('Workbench\Database\Model\','fk_user');
    // }








}
