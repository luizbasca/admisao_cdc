<div>
    {{-- Mensagens de Feedback --}}
    @include('livewire.partials.messages')

    <form wire:submit.prevent="salvar">

        {{-- Dados da Empresa - NOVA SEÇÃO --}}
        @include('livewire.funcionario.dados-empresa')

        {{-- Dados do Funcionário --}}
        @include('livewire.funcionario.dados-pessoais')

        {{-- Documento de Identificação --}}
        @include('livewire.funcionario.documento-identificacao')

        {{-- Endereço --}}
        @include('livewire.funcionario.endereco')

        {{-- Funcionário Estrangeiro --}}
        @include('livewire.funcionario.dados-estrangeiro')

        {{-- Dependentes --}}
        @include('livewire.funcionario.dependentes')

        {{-- Sindicato --}}
        @include('livewire.funcionario.dados-sindicato')

        {{-- Multiplos Vinculos --}}
        @include('livewire.funcionario.dados-vinculo-empregaticio')

        {{-- Observações --}}
        @include('livewire.funcionario.observacao')

        {{-- Declarações e Concordâncias --}}
        @include('livewire.funcionario.concordancias')

        {{-- Botões de Ação --}}
        @include('livewire.partials.form-actions')
    </form>
</div>