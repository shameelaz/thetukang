<?php

namespace Workbench\Database\Model\User;

use Illuminate\Database\Eloquent\Model;

class ARole extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'acl_roles';


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function permission()
    {
        return $this->hasMany('Workbench\Database\Model\Permission','role_id','id');
    }
   


}
