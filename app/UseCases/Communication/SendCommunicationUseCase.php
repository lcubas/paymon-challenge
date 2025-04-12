<?php

namespace App\UseCases\Communication;

use App\Repositories\Contracts\CommunicationRepositoryInterface;
use App\Repositories\Contracts\LegalGuardianRepositoryInterface;
use App\DTOs\CommunicationDTO;
use App\Models\Communication;
use Exception;

class SendCommunicationUseCase
{
    protected $communicationRepository;
    protected $legalGuardianRepository;

    public function __construct(
        CommunicationRepositoryInterface $communicationRepository,
        LegalGuardianRepositoryInterface $legalGuardianRepository
    ) {
        $this->communicationRepository = $communicationRepository;
        $this->legalGuardianRepository = $legalGuardianRepository;
    }

    public function execute(CommunicationDTO $communication): Communication
    {
        if (empty($communication->courseId)) {
            throw new Exception('Debe proporcionar un curso');
        }

        $guardians = [];

        // TODO: Missing association between communication and guardians
        if (!empty($communication->course_id)) {
            $guardians = $this->legalGuardianRepository->findByCriteria([
                'course_id' => $communication->courseId,
            ]);
        }

        // TODO: Implements email sending logic or some other communication method
        foreach ($guardians as $guardian) {
            info("Enviando comunicado a {$guardian->email}: {$communication->title}");
        }

        // Crear el registro del comunicado
        $communication = $this->communicationRepository->create([
            'title' => $communication->title,
            'message' => $communication->message,
            'sent_at' => now(),
            'course_id' => $communication->courseId,
        ]);

        return $communication;
    }
}
