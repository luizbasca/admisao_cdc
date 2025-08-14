@extends('layouts.app')

@section('title', 'Cadastrar Funcionário')

@section('content')

<div class="container">
    <!-- Header -->
    <header class="header-section bg-gradient-primary rounded-3 shadow-sm p-4 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-2">
                    <div class="icon-wrapper bg-white rounded-circle p-3 me-3 shadow-sm">
                        <i class="bi bi-person-plus-fill text-primary fs-3"></i>
                    </div>
                    <div>
                        <h1 class="display-6 fw-bold text-white mb-1">
                            Cadastrar Funcionário
                        </h1>
                        <p class="lead text-white-50 mb-0">
                            <i class="bi bi-building me-1"></i>
                            Sistema E-Social - Admissão CDC
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex flex-column align-items-md-end">
                    <small class="text-white-50 mb-1">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ date('d/m/Y') }}
                    </small>
                    <div class="btn-group" role="group">

                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="tooltip" title="Ajuda">
                            <i class="bi bi-question-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Progress indicator integrado com Livewire -->
        
    </header>

    <main class="p-1">
        <livewire:funcionario-form />
    </main>
</div>
