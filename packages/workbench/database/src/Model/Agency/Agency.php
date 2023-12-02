<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agency';

    public function ptj()
    {
        return $this->hasMany('Workbench\Database\Model\Agency\Ptj','fk_agency','id');
    }

    public function profile()
    {
        return $this->hasOne('Workbench\Database\Model\User\UserProfile','fk_users','id');
    }

    public function role()
    {
        return $this->hasMany('Overdrive\Web\Model\Urole','user_id','id');
    }
}
