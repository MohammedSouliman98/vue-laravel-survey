<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Survey;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\SurveyAnswer;
use Illuminate\Http\Request;

use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionAnswer;
use Illuminate\Support\Facades\File;
use App\Http\Resources\Surveyresource;
use App\Http\Requests\StoreSurveyRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Requests\StoreSurveyAnswerRequest;
use Symfony\Component\VarDumper\VarDumper;

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

        
        if (isset($data['image'])) {
            $imagepath = $this->saveImage($data['image']);
            $data['image'] = $imagepath;
        }
        

        $survey = Survey::create($data);

        foreach ($data['questions'] as $question) {
            $question['survey_id'] = $survey->id;
            $this->createQuestion($question);
        }
        return new Surveyresource($survey);
    }
    public function showforgust(Survey $survey)
    {

        return new Surveyresource($survey);
    }

    public function storeAnswer(StoreSurveyAnswerRequest $request, Survey $survey)
    {
        $validated = $request->validated();

        $surveyAnswer = SurveyAnswer::create([
            'survey_id' => $survey->id,
            'started_at' => date('Y-m-d'),
            'ended_at' => date('Y-m-d'),
        ]);

        foreach ($validated['answers'] as $questionId => $answer) {
            $question = SurveyQuestion::where(['id' => $questionId, 'survey_id' => $survey->id])->get();
            if (!$question) {
                return response("indvaled question id : \"$question\"", 400);
            }
            $data = [
                'survey_question_id' => $questionId,
                'survey_answer_id' => $surveyAnswer->id,
                'answer' => is_array($answer) ? json_encode($answer) : $answer
            ];
            SurveyQuestionAnswer::create($data);
        }

        return response("", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $survey->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return new Surveyresource($survey);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $data = $request->validated();

        
        
        
        if(isset($data['image'])){
            $relativepath = $this->saveImage($data['image']);
            if($relativepath){
            if($survey->image){
            $absolutepath = public_path($survey->image);
            File::delete($absolutepath);
                }
            $data['image'] = $relativepath;
            }
        }
        
        // var_dump($relativepath);

        $survey->update($data);


        $existingIds = $survey->questions()->pluck('id')->toArray();

        $newIds = Arr::pluck($data['questions'], 'id');

        $toDelete = array_diff($existingIds, $newIds);

        $toAdd = array_diff($newIds, $existingIds);

        SurveyQuestion::destroy($toDelete);

        foreach ($data['questions'] as $question) {
            if (in_array($question['id'], $toAdd)) {
                $question['survey_id'] = $survey->id;
                $this->createQuestion($question);
            }
        }

        $questionMap  = collect($data['questions'])->keyBy('id');

        foreach ($survey->questions as $question) {
            if (isset($questionMap[$question->id])) {
                $this->updatequestion($question, $questionMap[$question->id]);
            }
        }

        // return new Surveyresource($survey);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey, Request $request)
    {
        // $user = $request->user();
        // if($user->id !== $survey->user_id){
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }
        $survey->delete();
        return response()->json(['message' => 'Survey deleted successfully']);
    }

    private function createQuestion($data)
    {


        if (is_array($data['data'])) {
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

    private function updatequestion(SurveyQuestion $question, $data)
    {

        if (is_array($data['data'])) {
            $data['data'] = json_encode($data['data']);
        }
        $validator = Validator::make($data, [
            'id' => 'exists:survey_questions,id',
            'question' => 'required|string|max:255',
            'type' => 'required|in:text,select,radio,checkbox,textarea',
            'data' => 'present',
            'description' => 'nullable|string',
        ]);
        return $question->update($validator->validated());
    }

    private function saveImage($image)
    {
        if (preg_match('/data:image\/(\w+);base64,/', $image, $type)) {
            $image =  substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]);
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new Exception('invaled image');
            }
            $image = str_replace(" ", '+', $image);
            $image = base64_decode($image);
            if ($image === false) {
                throw new Exception('base64_decode failed');
            }
        } 
        // else {
        //     throw new Exception('data did not match');
        // }

        if($type){
            $dir = "images/";
            $file = Str::random() . "." . $type;
            $absolutepath = public_path($dir);
            $relativepath = $dir . $file;


            if (!File::exists($absolutepath)) {
                File::makeDirectory($absolutepath, 0755, true);
            }
            file_put_contents($relativepath, $image);
            return $relativepath;
        }
    }
}
