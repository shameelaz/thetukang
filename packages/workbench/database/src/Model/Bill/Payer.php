<?php

namespace Workbench\Database\Model\Bill;

use Illuminate\Database\Eloquent\Model;

class Payer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payer';


    public function fkagency()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','fk_agency');
    }

    public function fkptj()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Ptj','fk_ptj');
    }









}
