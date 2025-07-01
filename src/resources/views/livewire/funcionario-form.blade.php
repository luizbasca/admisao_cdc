<div>
    {{-- Mensagens de Feedback --}}
    @include('livewire.partials.messages')
    
    <form wire:submit.prevent="salvar">
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

        {{-- Vínculo Empregatício --}}
        @include('livewire.funcionario.dados-vinculo-empregaticio')

        {{-- Observações --}}
        @include('livewire.funcionario.observacao')

        {{-- Declarações e Concordâncias --}}
        @include('livewire.funcionario.concordancias')

        {{-- Botões de Ação --}}
        @include('livewire.partials.form-actions')
    </form>
</div>