<?php

namespace Workbench\Database\Model\User;

use Illuminate\Database\Eloquent\Model;

class APermission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'acl_permissions';


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    // public function name()
    // {
    //     return $this->hasOne('Workbench\Site\Model\APermission','id','permission_id');
    // }


}
