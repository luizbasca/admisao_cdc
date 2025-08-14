<div class="step-indicator-detailed mb-4">
    <div class="current-step-info">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="mb-1">
                    <i class="{{ $steps[$currentStep]['icon'] }} me-2"></i>
                    {{ $steps[$currentStep]['title'] }}
                </h4>
                <p class="text-muted mb-0">
                    @switch($currentStep)
                        @case(1)
                            Informe os dados da empresa contratante
                            @break
                        @case(2)
                            Preencha as informações pessoais do funcionário
                            @break
                        @case(3)
                            Adicione os documentos de identificação
                            @break
                        @case(4)
                            Informe o endereço residencial
                            @break
                        @case(5)
                            Dados específicos para funcionários estrangeiros
                            @break
                        @case(6)
                            Cadastre os dependentes, se houver
                            @break
                        @case(7)
                            Informações sobre filiação sindical
                            @break
                        @case(8)
                            Dados sobre múltiplos vínculos empregatícios
                            @break
                        @case(9)
                            Observações finais e concordâncias
                            @break
                    @endswitch
                </p>
            </div>
            <div class="col-md-4 text-end">
                <div class="step-counter">
                    <span class="badge bg-primary fs-6">
                        {{ $currentStep }}/{{ $totalSteps }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>