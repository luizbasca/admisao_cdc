<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;

// Agrupamento de rotas relacionadas a funcionários com prefixo e nome
Route::prefix('funcionarios')->name('funcionarios.')->group(function () {
    // Rota principal (index)
    Route::get('/', [FuncionarioController::class, 'index'])->name('index');

    // Rota para criar novo funcionário
    Route::get('/create', [FuncionarioController::class, 'create'])->name('create');

    // Rota para salvar funcionário
    Route::post('/', [FuncionarioController::class, 'store'])->name('store');

    // Rota para visualizar funcionário específico
    Route::get('/{funcionario}', [FuncionarioController::class, 'show'])->name('show');

    // Rota para editar funcionário
    Route::get('/{funcionario}/edit', [FuncionarioController::class, 'edit'])->name('edit');

    // Rota para atualizar funcionário
    Route::put('/{funcionario}', [FuncionarioController::class, 'update'])->name('update');

    // Rota para deletar funcionário
    Route::delete('/{funcionario}', [FuncionarioController::class, 'destroy'])->name('destroy');

    // Rota específica para geração de PDF
    Route::get('/{funcionario}/pdf', [FuncionarioController::class, 'gerarPDF'])
        ->name('pdf')
        ->where('funcionario', '[0-9]+'); // Validação para aceitar apenas números
});

// Rota raiz redirecionando para funcionários
Route::get('/', function () {
    return redirect()->route('funcionarios.index');
});
