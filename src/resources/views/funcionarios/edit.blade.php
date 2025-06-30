@extends('layouts.app')

@section('title', 'Editar: ' . $funcionario->nome_completo)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">
            <i class="bi bi-pencil-fill me-2"></i>
            Editar Funcionário
        </h1>
        <p class="text-muted mb-0">{{ $funcionario->nome_completo }}</p>
    </div>
    <a href="{{ route('funcionarios.show', $funcionario) }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Voltar
    </a>
</div>

<!-- Substituindo o formulário estático por um componente Livewire -->
<div class="row justify-content-center">
    <div class="col-md-10">
        <livewire:funcionario-form :funcionario="$funcionario" />
    </div>
</div>
@endsection