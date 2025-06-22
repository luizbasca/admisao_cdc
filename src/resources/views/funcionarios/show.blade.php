@extends('layouts.app')

@section('title', 'Funcionário: ' . $funcionario->nome_completo)

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">
                <i class="bi bi-person-fill me-2 text-primary"></i>
                {{ $funcionario->nome_completo }}
            </h1>
            <p class="text-muted mb-0">
                <i class="bi bi-calendar-plus me-1"></i>
                Cadastrado em {{ $funcionario->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
        
        <div class="btn-group" role="group" aria-label="Ações do funcionário">
            <a href="{{ route('funcionarios.edit', $funcionario) }}" 
               class="btn btn-warning" 
               title="Editar funcionário">
                <i class="bi bi-pencil me-2"></i>Editar
            </a>
            <a href="{{ route('funcionarios.pdf', $funcionario) }}" 
               class="btn btn-success" 
               title="Gerar PDF do funcionário"
               target="_blank">
                <i class="bi bi-file-pdf me-2"></i>Gerar PDF
            </a>
            <a href="{{ route('funcionarios.index') }}" 
               class="btn btn-secondary" 
               title="Voltar à lista">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Dados Pessoais -->
        <div class="col-12">
            @include('funcionarios.partials.dados-pessoais', ['funcionario' => $funcionario])
        </div>

        <!-- Documento de Identificação -->
        <div class="col-12">
            @include('funcionarios.partials.documento-identificacao', ['funcionario' => $funcionario])
        </div>

        <!-- Endereço -->
        <div class="col-12">
            @include('funcionarios.partials.endereco', ['funcionario' => $funcionario])
        </div>

        <!-- Dados de Estrangeiro (condicional) -->
        @if($funcionario->isEstrangeiro())
        <div class="col-12">
            @include('funcionarios.partials.dados-estrangeiro', ['funcionario' => $funcionario])
        </div>
        @endif

        <!-- Dependentes -->
        <div class="col-12">
            @include('funcionarios.partials.dependentes', ['funcionario' => $funcionario])
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .info-item {
        margin-bottom: 1rem;
    }
    .info-item label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
        display: block;
    }
    .info-item p {
        font-size: 1rem;
        line-height: 1.4;
    }
    .bg-pink {
        background-color: #e91e63 !important;
    }
</style>
@endpush