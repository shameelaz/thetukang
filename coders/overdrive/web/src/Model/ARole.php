<?php

namespace Overdrive\Web\Model;

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
    // public function permission()
    // {
    //     return $this->hasMany('Overdrive\Web\Model\Mpermission','role_id','id');
    // }

    public function permission()
    {
        return $this->hasMany('Overdrive\Web\Model\Permission','role_id','id');
    }
   


}
