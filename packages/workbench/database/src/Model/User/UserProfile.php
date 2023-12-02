<?php

namespace Workbench\Database\Model\User;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profile';


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    // public function departments()
    // {
    //     return $this->hasOne('Workbench\Developer\Model\LkpDepartment','id','department');
    // }

    public function userPtj()
    {
        return $this->hasOne('Workbench\Database\Model\Agency\Ptj','id','fk_ptj');
    }

    public function userAgency()
    {
        return $this->hasOne('Workbench\Database\Model\Agency\Agency','id','fk_agency')->where('status','=',1);
    }

    public function user()
    {
        return $this->hasOne('Workbench\Database\Model\User\Users','id','fk_users');
    }

    public function position()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpPosition','fk_position');
    }

}
