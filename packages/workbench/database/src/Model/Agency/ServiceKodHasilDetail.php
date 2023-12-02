<?php

namespace Workbench\Database\Model\Agency;

use Illuminate\Database\Eloquent\Model;

class ServiceKodHasilDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_kod_hasil_detail';

    public function servicekodhasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\ServiceKodHasil','fk_service_kod_hasil');
    }

    public function hasil()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\KodHasil','fk_kod_hasil');
    }


}
