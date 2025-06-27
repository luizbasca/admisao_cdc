<!-- Exemplo: resources/views/funcionarios/create.blade.php -->
@extends('layouts.app')

@section('title', 'Cadastrar Funcionário')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4>Cadastro de Funcionário</h4>
            </div>
            <div class="card-body">
                <livewire:funcionario-form />
            </div>
        </div>
    </div>
</div>
@endsection