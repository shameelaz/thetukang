<?php

namespace Workbench\Database\Model\User;

use Illuminate\Database\Eloquent\Model;

class AclRoleUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'acl_role_user';
    public $timestamps = false; 
    protected $primary_key = 'user_id';
    public $incrementing = false;


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
  
    public function user()
    {
        return $this->hasOne('Workbench\Database\Model\Users','id','user_id');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function role()
    {
        return $this->belongsTo('Workbench\Database\Model\ARole','role_id','id');
    }

    public function arole()
    {
        return $this->hasOne('Workbench\Database\Model\User\ARole','id','role_id');
    }
}
