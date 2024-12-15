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

    public function listSupplier()
    {
        $suppliers = $this->supplierService->paginate();

        return view('suppliers', compact('suppliers'));
    }

    /**
        * @OA\Get(
        *     path="/api/suppliers",
        *     summary="Lista os fornecedores",
        *     tags={"Suppliers"},
        *     @OA\Response(
        *         response="200",
        *         description="OK"
        *     )
        * )
    */

    public function list()
    {
        $suppliers = $this->supplierService->list();

        return SupplierResource::collection($suppliers);
    }

    /**
        * @OA\Post(
        *     path="/api/suppliers",
        *     summary="Cria fornecedores",
        *     tags={"Suppliers"},
        *     @OA\Response(
        *         response="200",
        *         description="Fornecedor criado com sucesso"
        *     ),
        *     @OA\Response(
        *         response="400",
        *         description="Erro na requisição. Possíveis causas:
        *                      - Documento CPF/CNPJ inválido.
        *                      - CEP inválido.
        *                      - Erro ao criar fornecedor."
        *      ),
        *      @OA\Response(
        *         response="422",
        *         description="Erro de validação"
        *      )
        * )
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
        * @OA\Get(
        *     path="/suppliers/show/{id}",
        *     summary="Obter detalhes de um fornecedor",
        *     tags={"Suppliers"},
        *     @OA\Parameter(
        *         name="code",
        *         in="path",
        *         required=true,
        *         description="Código do fornecedor",
        *         @OA\Schema(type="string")
        *     ),
        *     @OA\Response(
        *         response="200",
        *         description="Detalhes do fornecedor"
        *     )
        * )
     */

    public function show(string $id): SupplierResource
    {
        $supplier = $this->supplierService->show($id);

        return new SupplierResource($supplier);
    }

    /**
        * @OA\Put(
        *     path="/suppliers/{id}",
        *     summary="Atualizar um fornecedor",
        *     tags={"Suppliers"},
        *     @OA\Response(
        *         response="200",
        *         description="Fornecedor atualizado com sucesso"
        *     ),
        *     @OA\Response(
        *         response="400",
        *         description="Erro na requisição. Possíveis causas:
        *                      - Documento CPF/CNPJ inválido.
        *                      - CEP inválido.
        *                      - Erro ao criar fornecedor."
        *      ),
        *      @OA\Response(
        *         response="422",
        *         description="Erro de validação"
        *      )
        * )
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
      * @OA\Delete(
        *     path="/suppliers/{code}",
        *     summary="Excluir um fornecedor",
        *     tags={"Suppliers"},
        *     @OA\Parameter(
        *         name="code",
        *         in="path",
        *         required=true,
        *         description="Código do fornecedor",
        *         @OA\Schema(type="string")
        *     ),
        *     @OA\Response(
        *         response="200",
        *         description="Fornecedor excluído com sucesso"
        *     ),
        *     @OA\Response(
        *         response="422",
        *         description="Falha para excluir o fornecedor"
        *     )
        * )
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $supplier = $this->supplierService->destroy($id);
            return response()->json(['message' => 'Fornecedor excluído com sucesso'], 200);
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
            return response()->json(['message' => 'Falha para excluir o fornecedor. Erro: ' .$errorMessage], 422);
        }
    }
}
