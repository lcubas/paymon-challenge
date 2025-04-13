<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'student' => new StudentResource($this->whenLoaded('student')),
            'course' => new CourseResource($this->whenLoaded('course')),
            'status' => $this->status,
            'payment' => new PaymentResource($this->whenLoaded('payment')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}