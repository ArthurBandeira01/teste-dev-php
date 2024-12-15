<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository
{
    public $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function list()
    {
        return $this->supplier->all();
    }

    public function store(array $request)
    {
        return $this->supplier->create($request);
    }

    public function show(int $id)
    {
        return $this->supplier->find($id);
    }

    public function update(int $id, array $request)
    {
        $supplier = $this->show($id);

        return $supplier->update($request);
    }

    public function destroy(int $id)
    {
        $supplier = $this->show($id);

        return $supplier->delete();
    }
}
