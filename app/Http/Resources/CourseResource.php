<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'courseType' => [
                'title' => $this->type->title,
            ],
            'staff' => [
                'name' => $this->staff->name,
                'email' => $this->staff->email,
            ],
            'lessons' => LessonResource::collection($this->whenLoaded('lessons')),
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
        ];
    }
}
