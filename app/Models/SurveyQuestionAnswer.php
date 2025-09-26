<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestionAnswer extends Model
{
    protected $fillable = ['survey_answer_id','survey_question_id','answer'];
}
