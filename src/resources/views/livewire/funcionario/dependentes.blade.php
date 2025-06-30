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
        @forelse($dependentes as $index => $dependente)
            @include('livewire.funcionario.partials.dependente-card', ['index' => $index, 'dependente' => $dependente])
        @empty
            @include('livewire.funcionario.partials.dependentes-empty')
        @endforelse
    </div>
</div>