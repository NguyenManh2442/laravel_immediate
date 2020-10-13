<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel(): string;

    /**
     * Set model
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function setModel(): void
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return Collection|static[]
     */
    public function getAll()
    {
        return $this->_model->all();
    }

    /**
     * @param string $status status = '' or null search all
     * @return mixed
     */
    public function getData($status = '')
    {
        $query = $this->_model->select('*');
        if ($status) {
            $query->where('status', $status);
        }
        if ($status === 0)
        {
            $query->where('status', $status);
        }
        return $query->get();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->_model->find($id);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

}
