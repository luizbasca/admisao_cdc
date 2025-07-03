<!-- Dependentes -->
<section class="card section-card" data-section="1">
    <div class="section-header">
        <i class="bi bi-person-fill"></i>
        <h2 class="h4 mb-0">Dependentes</h2>
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
</section>