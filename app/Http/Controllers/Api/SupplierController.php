<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Services\SupplierService;
use App\Helpers\FunctionsHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


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
    public function store(SupplierRequest $request): JsonResponse
    {
        try {
            // Valida cnpj/cpf
            $verifyDocument = FunctionsHelper::verifyDocument($request['document']);
            if (!$verifyDocument) {
                return response()->json(['message' => 'Documento CPF/CNPJ inválido.'], 400);
            }

            // Valida CEP
            $verifyCep = FunctionsHelper::verifyCep($request['mailcode']);
            if (!$verifyCep) {
                return response()->json(['message' => 'CEP inválido.'], 400);
            }

            $this->supplierService->store($request->validated());

            return response()->json(['message' => 'Fornecedor criado com sucesso'], 201);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Erro de validação', 'errors' => $e->errors()], 422);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Falha ao criar fornecedor. Erro: ' . $exception->getMessage()], 422);
        }
    }

    /**
     * Mostra o fornecedor escolhido
     */
    public function show(string $id): SupplierResource
    {
        $supplier = $this->supplierService->show($id);

        return new SupplierResource($supplier);
    }

    /**
     * Atualiza o fornecedor
     */
    public function update(SupplierRequest $request, string $id): JsonResponse
    {
        try {
            // Valida cnpj/cpf
            $verifyDocument = FunctionsHelper::verifyDocument($request['document']);
            if (!$verifyDocument) {
                return response()->json(['message' => 'Documento CPF/CNPJ inválido.'], 400);
            }

            // Valida CEP
            $verifyCep = FunctionsHelper::verifyCep($request['mailcode']);
            if (!$verifyCep) {
                return response()->json(['message' => 'CEP inválido.'], 400);
            }

            $this->supplierService->update($id, $request->validated());

            return response()->json(['message' => 'Fornecedor atualizado com sucesso'], 201);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Erro de validação', 'errors' => $e->errors()], 422);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Falha ao atualizar fornecedor. Erro: ' . $exception->getMessage()], 422);
        }
    }

    /**
     * Remove o fornecedor com soft delete
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $supplier = $this->supplierService->destroy($id);
            return response()->json(['message' => 'Fornecedor deletado com sucesso'], 201);
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
            return response()->json(['message' => 'Falha para criar fornecedor. Erro: ' .$errorMessage], 422);
        }
    }


    public function documentation(Request $request){
        dd('docs');
    }
}
