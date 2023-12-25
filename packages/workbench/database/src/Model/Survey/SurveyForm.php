<?php

namespace Workbench\Database\Model\Survey;

use Illuminate\Database\Eloquent\Model;

class SurveyForm extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'survey_form';

    public function user()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }

    public function survey()
    {
        return $this->belongsTo('Workbench\Database\Model\Survey\Survey','fk_survey');
    }




}
