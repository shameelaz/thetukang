<?php
namespace Overdrive\Web\Model;

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


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function permission()
    {
        return $this->hasMany('Overdrive\Web\Model\Mpermission','role_id','role_id');
    }

    public function name()
    {
        return $this->hasOne('Overdrive\Web\Model\ARole','id','role_id');
    }


}
