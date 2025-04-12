<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    /**
     * Find a model by its primary key.
     *
     * @param int $id
     * @param array $relations
     * @return mixed
     */
    public function find(int $id, array $relations = []);

    /**
     * Get all models.
     *
     * @param array $relations
     * @return mixed
     */
    public function all(array $relations = []);

    /**
     * Create a new model.
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update an existing model.
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * Delete a model.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Find one record based on criteria.
     *
     * @param array $criteria
     * @param array $relations
     * @return mixed
     */
    public function findByCriteria(array $criteria, array $relations = []);

    /**
     * Find records based on criteria.
     *
     * @param array $criteria
     * @param array $relations
     * @return mixed
     */
    public function getByCriteria(array $criteria, array $relations = []);
}
