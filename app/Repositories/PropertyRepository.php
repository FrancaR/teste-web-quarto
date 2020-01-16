<?php

namespace App\Repositories;

use App\Models\Property;
use App\Services\GoogleMaps;
use Illuminate\Support\Arr;

class PropertyRepository implements PropertyRepositoryInterface
{
    /**
     * model property on class instances.
     */
    protected $model;

    /**
     * Constructor to bind model to repo.
     *
     * @return \App\Models\Property
     */
    public function __construct(Property $property)
    {
        $this->model = $property;
    }

    /**
     * Get all records from model.
     *
     * @return \App\Models\Property
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Show the record with the given id.
     *
     * @return \App\Models\Property
     */
    public function show(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $e) {
            report($e);

            return abort(404, $e->getMessage());
        }
    }

    /**
     * Create a new record.
     *
     * @return \App\Models\Property
     */
    public function create(array $data)
    {
        $geocode = new GoogleMaps();
        $position = $geocode->byAddress($data['address'], $data['neighborhood'], $data['city'], $data['state']);

        $data = Arr::add($data, 'lat', $position['lat']);
        $data = Arr::add($data, 'lng', $position['lng']);
        $data = Arr::add($data, 'user_id', auth()->user()->id);

        return $this->model->create($data);
    }

    /**
     * Update record.
     *
     * @param int $id
     *
     * @return \App\Models\Property
     */
    public function update(array $data, $id)
    {
        return tap($this->model->findOrFail($id))->update($data);
    }

    /**
     * Remove record from the database.
     *
     * @return \App\Models\Property
     */
    public function delete(int $id)
    {
        return tap($this->model->findOrFail($id))->delete();
    }

    /**
     * Get the associated model.
     *
     * @return \App\Models\Property
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the asscoiated model.
     *
     * @param $model
     *
     * @return \App\Models\Property
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the query for lazy load.
     *
     * @return \App\Models\Property
     */
    public function query()
    {
        return $this->model->query();
    }

    /**
     * Get the scope with only owner.
     *
     * @return \App\Models\Property
     */
    public function owned()
    {
        return $this->model->owned();
    }

    /**
     * Get the is owner based on user auth.
     */
    public function isOwner(int $id): bool
    {
        return $this->show($id)->owner->id === auth()->user()->id;
    }

    /**
     * Get the paginate.
     *
     * @return \App\Models\Property
     */
    public function paginate(int $itens)
    {
        return $this->model->paginate($itens);
    }
}
