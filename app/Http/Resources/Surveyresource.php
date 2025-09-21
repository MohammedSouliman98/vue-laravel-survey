<?php

namespace App\Http\Resources;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Surveyresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title, 
            'slug'  => $this->slug,  
            'description' => $this->description,
            'status' => $this->status !== 'draft',
            'expire_at' => $this->expire_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'questions' => SurveyQuestionResource::collection($this->questions),
        ];
    }
}
