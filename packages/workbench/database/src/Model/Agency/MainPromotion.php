<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class MainPromotion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'main_promotion';

    public function user()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }
    
}
