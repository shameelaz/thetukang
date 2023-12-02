<?php

namespace Workbench\Database\Model\User;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'acl_permission_role';


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function name()
    {
        return $this->hasOne('Workbench\Database\Model\APermission','id','permission_id');
    }


}
