@extends('layouts.app')

@section('title', 'Cadastrar Funcionário')

@section('content')

<div class="container">
    <!-- Header -->
    <header class="header-section">
        <h1 class="display-5 fw-bold mb-2">
            <i class="bi bi-person-plus-fill me-2"></i>
            Formulário de Cadastro de Funcionário
        </h1>
        <p class="lead mb-0">Sistema E-Social</p>
    </header>
    <main class="p-4">
        <livewire:funcionario-form />
    </main>
</div>


@endsection