<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    private Model $Model;

    public function __construct(Model $Model)
    {
        $this->Model = $Model;
    }

    public function all()
    {
        return $this->Model->all();
    }

    public function find($id, array $columns = ['*'])
    {
        return $this->Model->select($columns)->find($id);
    }

    public function findBy(array $attributes, array $columns = ['*'])
    {
        return $this->Model->select($columns)->where($attributes)->get();
    }

    public function findByFirst(array $attributes, array $columns = ['*'])
    {
        return $this->Model->select($columns)->where($attributes)->first();
    }

    public function create(array $data)
    {
        return $this->Model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->Model->find($id)->update($data);
    }

    public function updateBy(array $attributes, array $data)
    {
        return $this->Model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->Model->destroy($id);
    }
}