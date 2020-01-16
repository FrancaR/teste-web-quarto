<?php

namespace App\Repositories;

interface PropertyRepositoryInterface
{
    public function all();

    public function show(int $id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete(int $id);

    public function paginate(int $itens);
}