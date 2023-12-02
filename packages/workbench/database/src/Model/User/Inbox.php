<?php

namespace Workbench\Database\Model\User;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inbox';


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function to()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','kepada');
    }

    public function from()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','daripada');
    }







}
