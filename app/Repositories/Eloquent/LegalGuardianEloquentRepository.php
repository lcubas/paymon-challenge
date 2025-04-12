<?php

namespace App\Repositories\Eloquent;

use App\Models\LegalGuardian;
use App\Repositories\Contracts\LegalGuardianRepositoryInterface;

class LegalGuardianEloquentRepository extends BaseEloquentRepository implements LegalGuardianRepositoryInterface
{
    /**
     * LegalGuardianEloquentRepository constructor.
     *
     * @param LegalGuardian $model
     */
    public function __construct(LegalGuardian $model)
    {
        parent::__construct($model);
    }
}

