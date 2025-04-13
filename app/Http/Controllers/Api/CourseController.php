<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CourseResource;
use App\UseCases\Course\GetCoursesUseCase;
use App\UseCases\Course\GetCourseByIdUseCase;
use App\UseCases\Course\DTOs\CourseFilterDTO;
use Exception;

class CourseController extends BaseApiController
{
    public function __construct(
        private readonly GetCoursesUseCase $getCoursesUseCase,
        private readonly GetCourseByIdUseCase $getCourseByIdUseCase
    ) {}

    public function index()
    {
        try {
            $filters = new CourseFilterDTO(
                courseId: request('course_id'),
                academyId: request('academy_id')
            );
            
            $courses = $this->getCoursesUseCase->execute($filters);
            return $this->respondWithCollection(
                CourseResource::collection($courses),
                'Courses retrieved successfully'
            );
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show(int $id)
    {
        try {
            $course = $this->getCourseByIdUseCase->execute($id);
            return $this->respondWithItem(
                new CourseResource($course),
                'Course retrieved successfully'
            );
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}