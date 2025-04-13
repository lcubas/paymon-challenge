<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CommunicationResource;
use App\UseCases\Communication\SendCommunicationUseCase;
use App\UseCases\Communication\DTOs\SendCommunicationDTO;
use App\Http\Requests\Api\SendCommunicationRequest;
use Exception;

class CommunicationController extends BaseApiController
{
    public function __construct(
        private readonly SendCommunicationUseCase $sendCommunicationUseCase
    ) {}

    public function store(SendCommunicationRequest $request)
    {
        try {
            $communication = $this->sendCommunicationUseCase->execute(
                new SendCommunicationDTO(
                    courseId: $request->course_id,
                    title: $request->title,
                    message: $request->content,
                )
            );

            return $this->respondWithItem(
                new CommunicationResource($communication),
                'Communication created and sent successfully'
            );
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
