<?php

namespace App\Repositories\Contracts;

interface StudentRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find a student by their attributes or create a new student if not found.
     *
     * @param array $attributes
     * @return mixed
     */
    public function findOrCreate(array $attributes);
}
