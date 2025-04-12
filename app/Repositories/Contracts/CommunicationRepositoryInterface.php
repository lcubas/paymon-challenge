<?php

namespace App\Repositories\Contracts;

interface CommunicationRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get communications for a specific course.
     *
     * @param int $courseId
     * @return mixed
     */
    public function getByCourse(int $courseId);

    /**
     * Mark a communication as sent.
     *
     * @param int $id
     * @return mixed
     */
    public function markAsSent(int $id);
}
