{{-- resources/views/livewire/funcionario/dependentes.blade.php --}}
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Dependentes</h5>
        <button type="button" 
                class="btn btn-primary" 
                wire:click="adicionarDependente" 
                @if(count($dependentes) >= $maxDependentes) disabled @endif>
            <i class="bi bi-plus"></i> Adicionar
        </button>
    </div>
    <div class="card-body">
        <div class="alert alert-warning" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Atenção:</strong> Caso o funcionário tenha dependentes para o Imposto de Renda, 
            é obrigatório preencher a Declaração de Dependentes para o Imposto de Renda.
        </div>

        @forelse($dependentes as $index => $dependente)
            @include('livewire.funcionario.partials.dependente-card', ['index' => $index, 'dependente' => $dependente])
        @empty
            @include('livewire.funcionario.partials.dependentes-empty')
        @endforelse
    </div>
</div>