<?php

use App\Http\Controllers\Api\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SupplierController::class, 'listSupplier'])->name('listSupplier');
