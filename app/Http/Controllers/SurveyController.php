<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Http\Resources\Surveyresource;
use App\Http\Requests\StoreSurveyRequest;

use Illuminate\Support\Facades\Validator;

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
        $data = $request->validated() ;
        
        $survey = Survey::create($data);

        foreach ( $data['questions'] as $question){
            $question['survey_id'] = $survey->id;
            $this->createQuestion($question);
        }
        return new Surveyresource($survey);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey, Request $request)
    {
        $user = $request->user();
        if($user->id !== $survey->user_id){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
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

    private function createQuestion($data){
        

        if(is_array($data['data'])){
            $data['data'] = json_encode($data['data']);
        }
        $validator = Validator::make($data, [
            'survey_id' => 'required|exists:surveys,id',
            'question' => 'required|string|max:255',
            'type' => 'required|in:text,select,radio,checkbox,textarea',
            'data' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        return SurveyQuestion::create($validator->validated());
    }
}
