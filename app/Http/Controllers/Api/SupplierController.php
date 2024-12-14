<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Lista os fornecedores
     */
    public function list()
    {
        $suppliers = $this->supplierService->list();

        return SupplierResource::collection($suppliers);
    }

    /**
     * Cria o fornecedor
     */
    public function store(SupplierRequest $request)
    {
        $validatedData = $request->validated();

        if ($validatedData) {
            try {
                $this->supplierService->store($validatedData);

                return response()->json(['message' => 'Fornecedor criado com sucesso'], 201);
            } catch (\Exception $exception){
                $errorMessage = $exception->getMessage();
                return response()->json(['message' => 'Falha para criar fornecedor. Erro: ' .$errorMessage], 422);
            }
        }

        return response()->json(['message' => 'Erro ao validar dados do fornecedor'], 400);
    }

    /**
     * Mostra o fornecedor escolhido
     */
    public function show(string $id)
    {
        $supplier = $this->supplierService->show($id);
    }

    /**
     * Atualiza o fornecedor
     */
    public function update(SupplierRequest $request, string $id)
    {
        try {
            $supplier = $this->supplierService->update($id, $request);
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
            return response()->json(['message' => 'Falha para criar fornecedor. Erro: ' .$errorMessage], 422);
        }
    }

    /**
     * Remove o fornecedor com soft delete
     */
    public function destroy(string $id)
    {
        try {
            $supplier = $this->supplierService->delete($id);
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
            return response()->json(['message' => 'Falha para criar fornecedor. Erro: ' .$errorMessage], 422);
        }
    }
}
