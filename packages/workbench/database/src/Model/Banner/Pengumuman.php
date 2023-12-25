<?php

namespace Workbench\Database\Model\Banner;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pengumuman';


    public function user()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }






}
