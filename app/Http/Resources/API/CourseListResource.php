<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseListResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        // System is now free, hardcode price and discount to 0
        $price = 0;
        $discount = 0;
        return [
            'slug'           => (string) $this->slug,
            'title'          => (string) $this->title,
            'thumbnail'      => (string) $this->thumbnail,
            'price'          => $price,
            'discount'       => $discount,
            'instructor'     => new InstructorResource($this->instructor),
            'students'       => 0, // Enrollment system removed - free access
            'average_rating' => (float) $this->average_rating,
        ];
    }
}
