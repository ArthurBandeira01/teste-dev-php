<?php

use App\Http\Controllers\Api\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas Web Supplier
Route::prefix('suppliers')->group(function () {
    // Listar todos os fornecedores
    Route::get('/', [SupplierController::class, 'list'])->name('listSupplier');

    // Criar um novo fornecedor
    Route::post('/', [SupplierController::class, 'store'])->name('storeSupplier');

    // Mostra o fornecedor
    Route::put('/show/{id}', [SupplierController::class, 'show'])->name('showSupplier');

    // Atualizar um fornecedor existente
    Route::put('/{id}', [SupplierController::class, 'edit'])->name('editSupplier');

    // Excluir um fornecedor
    Route::delete('/{id}', [SupplierController::class, 'delete'])->name('deleteSupplier');
});
