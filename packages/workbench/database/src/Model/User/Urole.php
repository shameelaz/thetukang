<?php

namespace Workbench\Database\Model\User;

use Illuminate\Database\Eloquent\Model;

class Urole extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'acl_role_user';

    public $timestamps = false; 
    protected $primary_key = null;
    public $incrementing = false;
    


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function permission()
    {
        return $this->hasMany('Workbench\Database\Model\Permission','role_id','role_id');
    }

    public function name()
    {
        return $this->hasOne('Workbench\Database\Model\ARole','id','role_id');
    }


}
