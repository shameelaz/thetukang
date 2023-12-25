<?php

namespace Workbench\Database\Model\Audit;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'audit_trail';

    public function user()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','userid');
    }




}
