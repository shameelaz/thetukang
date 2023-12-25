<?php

namespace Workbench\Database\Model\Base;

use Illuminate\Database\Eloquent\Model;

class PanduanPdf extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'panduan_pdf';


    public function agensi()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\Agency','fk_agensi');
    }

    public function lkpperkhidmatan()
    {
        return $this->belongsTo('Workbench\Database\Model\Lkp\LkpPerkhidmatan','fk_perkhidmatan');
    }

    



}
