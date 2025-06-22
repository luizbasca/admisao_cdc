<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;

// Agrupamento de rotas relacionadas a funcionários com prefixo e nome
Route::prefix('funcionarios')->name('funcionarios.')->group(function () {
    // Rota principal (index) - movida para dentro do grupo
    Route::get('/', [FuncionarioController::class, 'index'])->name('index');

    // Rotas de recurso completo (CRUD)
    Route::resource('/', FuncionarioController::class, [
        'parameters' => ['/' => 'funcionario']
    ])->except(['index']); // Excluindo index pois já foi definido acima

    // Rota específica para geração de PDF
    Route::get('/{funcionario}/pdf', [FuncionarioController::class, 'gerarPDF'])
        ->name('pdf')
        ->where('funcionario', '[0-9]+'); // Validação para aceitar apenas números
});

// Rota raiz redirecionando para funcionários (se necessário)
Route::get('/', function () {
    return redirect()->route('funcionarios.index');
});
