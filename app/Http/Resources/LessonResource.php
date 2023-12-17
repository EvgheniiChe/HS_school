<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'course' => [
                'title' => $this->course->type->title,
            ],
            'theme' => $this->theme,
            'startTime' => Carbon::parse($this->start_time)->format('Y-m-d H:i:s'),
            'info' => $this->info,
        ];
    }
}
