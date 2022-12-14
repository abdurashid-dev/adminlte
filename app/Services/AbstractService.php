<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class AbstractService
{
    //model
    protected $model;

    //since we are using livewire, index is not necessary, you can overwrite if you want

    public function show($id)
    {
        return $this->model::findOrFail($id);
    }

    public function create()
    {
        return new $this->model;
    }

    public function store(array $data)
    {
        $this->exracted($data);
    }

    public function edit($id)
    {
        return $this->show($id);
    }

    public function update(array $data, $id)
    {
        $item = $this->show($id);
        $this->exracted($data, $item);
    }

    public function destroy($id)
    {
        $item = $this->show($id);
        $item->delete();
    }

    /**
     * @return array
     */
    private function getFields()
    {
        return [];
    }

    private function exracted($data, $item = null)
    {
        $fields = $this->getFields();

        $rules = [];

        foreach ($fields as $field) {
            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            dd($validator->errors());
        }

        $data = $validator->validated();

        if (is_null($item)) {
            $item = new $this->model;
        }

        foreach ($fields as $field) {
            $field->fill($item, $data);
        }

        $item->save();
    }
}
