<?php

namespace App\Repositories;

use App\Models\PropertyPhoto as Photo;

class PhotoRepository implements PhotoRepositoryInterface
{
    /**
     * model photo on class instances
     */
    protected $model;

    /**
     * Constructor to bind model to repo.
     * 
     * @param \App\Models\PropertyPhoto $property
     * @return \App\Models\PropertyPhoto
     */
    public function __construct(Photo $photo)
    {
        $this->model = $photo;
    }

    /**
     * Create a new record.
     * 
     * @param array $data
     * @return \App\Models\PropertyPhoto
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
}