<?php
namespace App\Services;


use App\Repositories\BaseRepository;

class BaseService {

    protected $repository;
    public function __construct(BaseRepository $repository) {
        $this->repository = $repository;
    }

    public function all($relations = []) {
        return $this->repository->all($relations);
    }

    public function find($id, $relations = []) {
        return $this->repository->find($id, $relations);
    }

    public function findBy($field, $value = null) {
        if (is_array($field)) {
            return $this->repository->findBy($field);
        } else {
            return $this->repository->findBy($field, $value);
        }
    }

    public function findByIds($field, array $Ids) {
        return $this->repository->findByIds($field, $Ids);
    }

    public function paginate($items, $perPage, $page)
    {
        return $this->repository->paginate($items, $perPage, $page);
    }

    public function findByRelation($relation, $field, $value, $extraField, $extraValue)
    {
        return $this->repository->findByRelation($relation, $field, $value, $extraField, $extraValue);
    }

    public function store(array $data) {
        return $this->repository->store($data);
    }

    public function update($id, array $data) {
        return $this->repository->update($id, $data);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }

}
