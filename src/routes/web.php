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

    // Rota para visualizar funcionário específico (usando token)
    Route::get('/{funcionario:token}', [FuncionarioController::class, 'show'])->name('show');

    // Rota para editar funcionário (usando token)
    Route::get('/{funcionario:token}/edit', [FuncionarioController::class, 'edit'])->name('edit');

    // Rota para atualizar funcionário (usando token)
    Route::put('/{funcionario:token}', [FuncionarioController::class, 'update'])->name('update');

    // Rota para deletar funcionário (usando token)
    Route::delete('/{funcionario:token}', [FuncionarioController::class, 'destroy'])->name('destroy');

    // Rota específica para geração de PDF (usando token)
    Route::get('/{funcionario:token}/pdf', [FuncionarioController::class, 'gerarPDF'])
        ->name('pdf')
        ->where('funcionario', '[a-f0-9]{64}'); // Validação para aceitar apenas hash SHA256
});

// Rota raiz redirecionando para funcionários
Route::get('/', function () {
    return redirect()->route('funcionarios.index');
});
