<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrolledCourseResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'slug'       => (string) $this->course->slug,
            'title'      => (string) $this->course->title,
            'thumbnail'  => (string) $this->course->thumbnail,
            'instructor' => new InstructorResource($this->course->instructor),
            'students'   => 0, // Enrollment system removed - free access
            'progress'   => (int) $this->course->completed_percent,
        ];
    }
}
