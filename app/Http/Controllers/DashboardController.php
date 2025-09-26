<?php

namespace App\Http\Controllers;

use App\Http\Resources\SurveyAnswersResource;
use App\Http\Resources\Surveyresource;
use App\Http\Resources\SurveyresourceDashboard;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){

        $user = $request->user();

        //total number of survey 

        $total = Survey::query()->where('user_id' , $user->id)->count();

        // latest survey 

        $latest = Survey::query()->where('user_id', $user->id)->latest('created_at')->first();

        // Total number of answers 

        $totalAnswers = SurveyAnswer::query()
                        ->join('surveys' , 'survey_answers.survey_id' , '=' , 'surveys.id')
                        ->where('surveys.user_id' , $user->id)
                        ->count();


        // latest 5 answers 

        $latestAnswers = SurveyAnswer::query()
                        ->join('surveys' , 'survey_answers.survey_id' , '=' , 'surveys.id')
                        ->where('surveys.user_id' , $user->id)
                        ->orderBy('ended_at' , 'DESC')
                        ->limit(5)
                        ->get();
                        // getModel('survey_answers.*')

        return [
            'totalSurvey' => $total,
            'latestSurvey' => $latest ? new SurveyresourceDashboard($latest) : null,
            'totalAnswers' => $totalAnswers,
            'latestAnswers' => $latestAnswers
        ];


    }
}
