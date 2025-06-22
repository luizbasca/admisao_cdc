<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;

Route::get('/', [FuncionarioController::class, 'index'])->name('funcionarios.index');
Route::resource('funcionarios', FuncionarioController::class);
Route::get('/funcionarios/{funcionario}/pdf', [FuncionarioController::class, 'gerarPDF'])->name('funcionarios.pdf');
