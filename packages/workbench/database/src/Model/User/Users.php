<?php

namespace Workbench\Database\Model\User;

use Illuminate\Database\Eloquent\Model;


class Users extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $appends = ['level'];


    public function profile()
    {
        return $this->hasOne('Workbench\Database\Model\User\UserProfile','fk_users','id');
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function role()
    {
        // return $this->hasOne('Workbench\Database\Model\User\UserProfile');
        return $this->hasMany('Overdrive\Web\Model\Urole','user_id','id');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function getLevelAttribute()
    {
        if($this->user_level == 2){
            return "Pelanggan";
        }elseif($this->user_level == 1){
            return "Pengguna Dalaman";
        }else{
            return "Tiada Level";
        }

    }


    public function scopeInfo($query)
    {
        return $query->orderBy('users.created_at','desc')
        ->with('profile','role.name');
    }






}
