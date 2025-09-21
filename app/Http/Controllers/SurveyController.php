<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Resources\Surveyresource;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;


class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return Surveyresource::collection(Survey::where('user_id', $user->id)->paginate(10));

    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSurveyRequest $request)
    {
        $data = $request->validated();
        
        $survey = Survey::create($data);

        // foreach ( $data['questions'] as $question){
        //     $question['survey_id'] = $survey->id;
        //     $this->createQuestion($question);
        // }
        // return new Surveyresource($survey);

        return  $data;
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey, Request $request)
    {
        $user = $request->user();
        // if($user->id !== $survey->user_id){
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }
        return new Surveyresource($survey);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSurveyRequest $request, Survey $survey)
    {
        $survey->update($request->validated());
        return new Surveyresource($survey);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey ,Request $request )
    {
        // $user = $request->user();
        // if($user->id !== $survey->user_id){
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }
        $survey->delete();
        return response()->json(['message' => 'Survey deleted successfully']);
    }

    // private function createQuestion(array $data){
    //     $question = $survey->questions()->create([
    //         'survey_id' => $data['survey_id'],
    //         'question' => $data['question'],
    //         'type' => $data['type'],
    //         'description' => $data['description'] ?? null,
    //         'is_required' => $data['is_required'] ?? false,
    //     ]);

    //     if(in_array($data['type'], ['radio', 'checkbox', 'select']) && isset($data['options'])){
    //         foreach($data['options'] as $option){
    //             $question->options()->create([
    //                 'question_id' => $question->id,
    //                 'option' => $option,
    //             ]);
    //         }
    //     }
    //     return $question;
    // }
}
