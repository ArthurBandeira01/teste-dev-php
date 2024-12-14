<?php

use App\Http\Controllers\Api\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rotas API Supplier
Route::prefix('suppliers')->group(function () {
    // Listar todos os fornecedores
    Route::get('/', [SupplierController::class, 'list'])->name('supplier.list');

    // Criar um novo fornecedor
    Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');

    // Mostra o fornecedor
    Route::put('/show/{id}', [SupplierController::class, 'show'])->name('supplier.show');

    // Atualizar um fornecedor existente
    Route::put('/{id}', [SupplierController::class, 'update'])->name('supplier.update');

    // Excluir um fornecedor
    Route::delete('/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
});
