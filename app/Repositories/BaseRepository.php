<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use function App\Repository\request;

class BaseRepository {
    protected $modelName;

    public function getNewInstance() {
        $model = $this->modelName;
        return new $model;
    }

    public function all($relations = []) {
        $instance = $this->getNewInstance();
        return $instance->with($relations)->get();
    }

    public function find($id, $relations = []) {
        $instance = $this->getNewInstance();
        return $instance->with($relations)->find($id);
    }

    public function paginate($collection, $perPage, $page)
    {
        $page = $page ?? 1;
        $total = $collection->count();
        $items = $collection->forPage($page, $perPage);

        return new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

    public function store($data) {
        $instance = $this->getNewInstance();
        $instance->fill($data);
        $instance->save();
        return $instance;
    }

    public function update($id, $data) {
        $instance = $this->find($id);
        $instance->fill($data);
        $instance->save();
        return $instance;
    }

    public function findBy($fields, $value = null) {
        $instance = $this->getNewInstance();

        if (is_array($fields)) {
            foreach ($fields as $field => $value) {
                $instance = $instance->where($field, $value);
            }
        } else {
            $instance = $instance->where($fields, $value);
        }

        return $instance->get();
    }

    public function findByIds($field, array $ids) {
        $instance = $this->getNewInstance();
        return $instance->whereIn($field, $ids)->get();
    }

    public function findByRelation($relation, $field, $value, $extraField = null, $extraValue = null)
    {
        $instance = $this->getNewInstance();
        return $instance->whereHas($relation, function ($query) use ($field, $value, $extraField, $extraValue) {
            $query->where($field, $value);

            if ($extraField && $extraValue !== null) {
                $query->where($extraField, $extraValue);
            }
        })->get();
    }


    public function onlyFields(Collection $collection, $fields = []) {
        return $collection->transform(function($item, $key) use ($fields) {
            return $item->only($fields);
        });
    }

    public function delete($id) {
        $instance = $this->find($id);
        $instance->delete();
    }

}