<?php

namespace App\Models;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = ['survey_id' ,'started_at' ,'ended_at'];


    public function survey(){
      return $this->belongsTo(Survey::class);
  }

}
