<?php

namespace Workbench\Database\Model\Lkp;

use Illuminate\Database\Eloquent\Model;

class LkpPerkhidmatan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lkp_perkhidmatan';

    public function codehasil()
    {
        return $this->hasMany('Workbench\Database\Model\Agency\KodHasil', 'fk_perkhidmatan');
    }




}
