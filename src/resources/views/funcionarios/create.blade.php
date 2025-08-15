@extends('layouts.app')

@section('title', 'Cadastrar Funcionário')

@push('styles')
<!-- Estilos adicionais para melhor integração -->
<style>
    .help-button-container a:focus {
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.25) !important;
        /* Verde para o focus também */
        outline: none;
    }

    /* Animação suave para o ícone do WhatsApp com cor verde no hover */
    .help-button-container a:hover .bi-whatsapp {
        animation: pulse 1s infinite;
        color: white;
        /* Garante que o ícone fique branco no hover */
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }
</style>
@endpush

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
                            Painel de Admissão de Funcionários
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex flex-column align-items-md-end">
                    <!-- Botão de ajuda melhorado -->
                    <div class="help-button-container">

                        <a href="https://wa.me/5548984442902?text=Olá,%20preciso%20de%20ajuda%20com%20o%20cadastro%20de%20funcionário"
                            target="_blank"
                            class="btn btn-outline-light btn-sm d-md-inline-flex align-items-center px-3 py-2 rounded-pill shadow-sm"
                            data-bs-toggle="tooltip"
                            title="Precisa de ajuda? Fale conosco no WhatsApp"
                            style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
                            <i class="bi bi-whatsapp me-2 fs-6"></i>
                            <span class="fw-medium">Precisa de Ajuda?</span>
                        </a>

                    </div>
                </div>
            </div>

            <!-- Progress indicator -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="progress-container">
                        <div class="progress-header">
                            <div class="progress bg-white bg-opacity-25" style="height: 6px;">
                                <div class="progress-bar bg-white"
                                    role="progressbar"
                                    id="form-progress"
                                    style="width: 11%"
                                    aria-valuenow="1"
                                    aria-valuemin="0"
                                    aria-valuemax="9">
                                </div>
                            </div>
                            <div class="step-info text-center mt-2">
                                <small class="text-white-50" id="step-info">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Passo <span id="current-step">1</span> de <span id="total-steps">9</span>
                                    (<span id="progress-percentage">11</span>% concluído)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </header>

    <main class="p-1">
        <livewire:funcionario-form />
    </main>
</div>

@push('scripts')
<!-- Script para atualizar o progress bar e efeitos do botão -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Escutar eventos do Livewire para atualizar o progress bar
        Livewire.on('step-changed', (data) => {
            const currentStep = data[0].step;
            const totalSteps = 9;
            const percentage = Math.round((currentStep / totalSteps) * 100);

            // Atualizar elementos do progress bar
            document.getElementById('form-progress').style.width = percentage + '%';
            document.getElementById('form-progress').setAttribute('aria-valuenow', currentStep);
            document.getElementById('current-step').textContent = currentStep;
            document.getElementById('progress-percentage').textContent = percentage;
        });

        // Adicionar efeitos hover aos botões de ajuda com cor verde
        const helpButtons = document.querySelectorAll('.help-button-container a');
        helpButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                // Mudança para verde no hover
                this.style.background = 'rgba(34, 197, 94, 0.9)'; // Verde
                this.style.borderColor = 'rgba(34, 197, 94, 1)';
                this.style.color = 'white';
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 12px rgba(34, 197, 94, 0.3)';
            });

            button.addEventListener('mouseleave', function() {
                // Volta ao estado original
                this.style.background = 'rgba(255, 255, 255, 0.1)';
                this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
                this.style.color = '';
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
            });
        });
    });
</script>
@endpush