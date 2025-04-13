<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AcademyResource;
use App\Http\Requests\Api\CreateAcademyRequest;
use App\UseCases\Academy\CreateAcademyUseCase;
use App\UseCases\Academy\GetAllAcademiesUseCase;
use Exception;

class AcademyController extends BaseApiController
{
    public function __construct(
        private readonly GetAllAcademiesUseCase $getAllAcademiesUseCase,
        private readonly CreateAcademyUseCase $createAcademyUseCase,
    ) {}

    public function index()
    {
        try {
            $academies = $this->getAllAcademiesUseCase->execute();

            return $this->respondWithCollection(
                AcademyResource::collection($academies),
                'Academies retrieved successfully'
            );
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(CreateAcademyRequest $request)
    {
        try {
            $academy = $this->createAcademyUseCase->execute($request->validated());
            
            return $this->respondWithItem(
                new AcademyResource($academy),
                'Academy created successfully'
            );
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
