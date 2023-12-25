<?php

namespace Workbench\Database\Model\View\Report;

use Illuminate\Database\Eloquent\Model;

class VWReportTerimaanJenisFpxCard extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vw_report_terimaan_jenis_fpxcard';

    public function fkagency()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','agency');
    }

    public function fkptj()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Ptj','ptj');
    }

}
