<?php

namespace Workbench\Database\Model\Base;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logo';
    protected $fillable = ['logo_negeri','logo_sistem'];





}
