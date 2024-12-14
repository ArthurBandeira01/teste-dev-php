<?php

namespace App\Services;

use App\Repositories\SupplierRepository;

class SupplierService
{
    public $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function list()
    {
        return $this->supplierRepository->list();
    }

    public function store(array $request)
    {
        return $this->supplierRepository->store($request);
    }

    public function show(int $id)
    {
        return $this->supplierRepository->show($id);
    }

    public function update(int $id, array $request)
    {
        return $this->supplierRepository->update($id, $request);
    }

    public function delete(int $id)
    {
        return $this->supplierRepository->delete($id);
    }
}
