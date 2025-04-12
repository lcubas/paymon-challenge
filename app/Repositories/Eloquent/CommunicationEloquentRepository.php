<?php

namespace App\Repositories\Eloquent;

use App\Models\Communication;
use App\Repositories\Contracts\CommunicationRepositoryInterface;
use Carbon\Carbon;

class CommunicationEloquentRepository extends BaseEloquentRepository implements CommunicationRepositoryInterface
{
    /**
     * CommunicationEloquentRepository constructor.
     *
     * @param Communication $model
     */
    public function __construct(Communication $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function getByCourse(int $courseId)
    {
        return $this->model->where('course_id', $courseId)->get();
    }

    /**
     * @inheritDoc
     */
    public function markAsSent(int $id)
    {
        $communication = $this->find($id);
        if ($communication) {
            $communication->sent_at = Carbon::now();
            $communication->save();
            return $communication;
        }

        return null;
    }
}
