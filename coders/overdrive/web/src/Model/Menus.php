<?php

namespace Overdrive\Web\Model;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu';


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function scopeLabel($query)
    {
        return $query->where('type', '=', '1')->orderBy('order','ASC');
    }

    public function scopeMain($query)
    {
        return $query->where('type', '=', '2')->orderBy('order','ASC');
    }

    public function child()
    {
        return $this->hasMany('Overdrive\Web\Model\Menus','parent_id','id')->orderBy('order','ASC');
    }

    public function submenu()
    {
        return $this->hasMany('Overdrive\Web\Model\Menus','parent_id','id')->orderBy('order','ASC');
    }

    public function parent()
    {
        return $this->hasOne('Overdrive\Web\Model\Menus','id','parent_id')->where('type','=','2')->orderBy('order','ASC');
    }

    // for menu Rendering
    public function activechild()
    {
        return $this->hasMany('Overdrive\Web\Model\Menus','parent_id','id')->where('status',1)->orderBy('order','ASC');
    }

    public function activesub()
    {
        return $this->hasMany('Overdrive\Web\Model\Menus','parent_id','id')->where('status',1)->orderBy('order','ASC');
    }


}
