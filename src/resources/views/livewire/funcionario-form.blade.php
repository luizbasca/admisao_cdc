<div>
    {{-- Mensagens de Feedback --}}
    @include('livewire.partials.messages')

    <form wire:submit.prevent="salvar">
        {{-- Renderizar apenas o passo atual --}}
        @switch($currentStep)
            @case(1)
                @include('livewire.funcionario.dados-empresa')
                @break
            @case(2)
                @include('livewire.funcionario.dados-pessoais')
                @break
            @case(3)
                @include('livewire.funcionario.documento-identificacao')
                @break
            @case(4)
                @include('livewire.funcionario.endereco')
                @break
            @case(5)
                @include('livewire.funcionario.dados-estrangeiro')
                @break
            @case(6)
                @include('livewire.funcionario.dependentes')
                @break
            @case(7)
                @include('livewire.funcionario.dados-sindicato')
                @break
            @case(8)
                @include('livewire.funcionario.dados-vinculo-empregaticio')
                @break
            @case(9)
                @include('livewire.funcionario.observacao')
                @include('livewire.funcionario.concordancias')
                @break
        @endswitch

        {{-- Navegação entre passos --}}
        <div class="step-navigation mt-4">
            <div class="row">
                <div class="col-6">
                    @if($currentStep > 1)
                        <button type="button" 
                                wire:click="previousStep" 
                                class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Voltar
                        </button>
                    @endif
                </div>
                <div class="col-6 text-end">
                    @if($currentStep < $totalSteps)
                        <button type="button" 
                                wire:click="nextStep" 
                                class="btn btn-primary">
                            Próximo
                            <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    @else
                        <button type="submit" 
                                class="btn btn-success">
                            <i class="bi bi-check-circle me-2"></i>
                            Finalizar Cadastro
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>