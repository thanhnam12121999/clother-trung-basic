<?php

namespace App\Repositories;

abstract class BaseRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BaseRepository constructor
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function model();

    /**
     * Set model
     */
    public function makeModel()
    {
        $this->model = app()->make(
            $this->model()
        );
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes = [])
    {
        $result = $this->find($id);
        if (!$result) {
            return false;
        }

        $result->update($attributes);
        return $result;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if (!$result) {
            return false;
        }

        $result->delete();
        return true;
    }
}
