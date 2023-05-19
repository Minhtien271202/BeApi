<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all(); //model::getall()
    }
    public function find(int $id): ?Model
    {
        return $this->model->find($id); //model::find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data); //model::create($data);
    }
    public function groupBy($string){
        return $this->model->groupBy($string); //model::groupBy
    }
    public function update(int $id, array $data): bool
    {
        $model = $this->find($id);
        if ($model) {
            return $model->update($data); //model::where('id', $id)->update($data);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        if ($model) {
            return $model->delete(); //model::find($id)->delete();
        }
        return false;
    }
}
