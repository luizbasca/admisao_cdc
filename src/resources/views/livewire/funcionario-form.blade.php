<div>
    {{-- Mensagens de Feedback --}}
    @include('livewire.partials.messages')
    
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

    {{-- Observações --}}
    @include('livewire.funcionario.observacao')

    {{-- Declarações e Concordâncias --}}
    @include('livewire.funcionario.concordancias')

    {{-- Botões de Ação --}}
    @include('livewire.partials.form-actions')
</div>