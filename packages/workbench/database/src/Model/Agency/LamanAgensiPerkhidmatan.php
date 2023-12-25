<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class LamanAgensiPerkhidmatan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'laman_agensi_perkhidmatan';

    public function lamanagensi()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\LamanAgensi','fk_laman_agensi');
    }


}
