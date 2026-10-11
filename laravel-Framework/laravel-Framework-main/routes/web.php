<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepairRequestController;

Route::get('/', [RepairRequestController::class, 'index'])->name('dashboard');
Route::get('/create', [RepairRequestController::class, 'create'])->name('repairs.create');
Route::post('/store', [RepairRequestController::class, 'store'])->name('repairs.store');
