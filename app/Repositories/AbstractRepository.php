<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->whereId($id)->first();
    }

    public function findAll()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->whereId($id)->update($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function delete($id)
    {
        if (!$registry = $this->model->whereId($id)->first()) {
            throw new \Exception('Registro não encontrado');
        }
        return $registry->delete();
    }

    public function paginate($perPage = null)
    {
        $perPage ?: $perPage = getenv('DEFAULT_PAGINATE', 15);

        return $this->model->paginate($perPage);
    }

    public function setCampos($campos = ['*'])
    {
        $this->model = $this->model->select($campos);
    }

    public function setOrdem($colunas = [])
    {
        if (count($colunas)) {
            foreach ($colunas as $key => $value) {
                preg_match('/[a-zA-Z]/', $key)
                    ? $this->model = $this->model->orderBy($key, $value)
                    : $this->model = $this->model->orderBy($value);
            }
        }
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setUsuarioLogado(string $campo, int $usuario): void
    {
        $this->model = $this->model->where($campo, $usuario);
    }
}