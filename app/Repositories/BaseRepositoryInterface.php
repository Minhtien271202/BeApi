<?php
namespace App\Repositories;
interface BaseRepositoryInterface
{
    /**
     * Get all records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection;

    /**
     * Find a record by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id): ?\Illuminate\Database\Eloquent\Model;

    /**
     * Create a new record.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): \Illuminate\Database\Eloquent\Model;

    /**
     * Update an existing record.
     *
     * @param  int  $id
     * @param  array  $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a record.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool;
}
