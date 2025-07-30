@extends('layouts.app')

@section('title', 'Cadastro Realizado com Sucesso')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <!-- Próximo Passo - Card Principal -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 2.5rem;"></i>
                    </div>

                    <h2 class="h5 fw-bold mb-3">Próximo Passo!</h2>
                    <p class="text-muted mb-4">
                        Baixe o documento PDF e envie para o responsável da empresa.
                    </p>

                    <a href="{{ route('funcionarios.pdf', $funcionario->token) }}"
                        class="btn btn-primary btn-lg px-4 mb-3">
                        <i class="bi bi-download me-2"></i>
                        Baixar o Documento
                    </a>

                    <!-- Aviso sobre exclusão dos dados -->
                    <div class="alert alert-warning mt-3">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Aviso de Privacidade:</strong> Em conformidade com a Lei Geral de Proteção de Dados (LGPD), informamos que todos os dados fornecidos serão automaticamente excluídos do sistema após a geração e o download do PDF, garantindo a segurança e a privacidade das informações.
                    </div>


                </div>
            </div>

            <!-- Ações Secundárias -->
            <div class="text-center">
                <a href="{{ route('funcionarios.create') }}"
                    class="btn btn-outline-secondary">
                    <i class="bi bi-person-plus me-1"></i>
                    Cadastrar Outro Funcionário
                </a>
            </div>

        </div>
    </div>
</div>
@endsection