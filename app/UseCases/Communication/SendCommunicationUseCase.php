<?php

namespace App\UseCases\Communication;

use App\Repositories\Contracts\CommunicationRepositoryInterface;
use App\Repositories\Contracts\LegalGuardianRepositoryInterface;
use App\Models\Communication;
use App\UseCases\Communication\DTOs\SendCommunicationDTO;

class SendCommunicationUseCase
{
    public function __construct(
        private readonly CommunicationRepositoryInterface $communicationRepository,
        private readonly LegalGuardianRepositoryInterface $legalGuardianRepository,
    ) {}

    public function execute(SendCommunicationDTO $communication): Communication
    {
        $guardians = $this->legalGuardianRepository->findByCourseId($communication->courseId);

        // TODO: Implements email sending logic or some other communication method
        // TODO: May be necessary to implement a queue for sending emails or scheduling tasks
        foreach ($guardians as $guardian) {
            info("Enviando comunicado a {$guardian->email}: {$communication->title}");
        }

        // Crear el registro del comunicado
        $communication = $this->communicationRepository->create([
            'title' => $communication->title,
            'message' => $communication->message,
            'sent_at' => time(),
            'course_id' => $communication->courseId,
        ]);

        return $communication;
    }
}
