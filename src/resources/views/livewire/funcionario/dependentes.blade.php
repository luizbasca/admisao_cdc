<!-- Dependentes -->
<section class="card section-card" data-section="5">
    <div class="section-header">
        <i class="bi bi-person-fill"></i>
        <h2 class="h4 mb-0">Dependentes</h2>
        @if(($funcionario['possui_dependentes'] ?? false) == '1')
            <button type="button" 
                    class="btn btn-primary" 
                    wire:click="adicionarDependente" 
                    @if(count($dependentes) >= $maxDependentes) disabled @endif>
                <i class="bi bi-plus"></i> Adicionar
            </button>
        @endif
    </div>
    <div class="card-body">
        <div class="row g-3">
            {{-- Possui Dependentes (obrigatório) --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select @error('funcionario.possui_dependentes') is-invalid @enderror"
                            wire:model.live="funcionario.possui_dependentes">
                        <option value="">Selecione...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Você possui dependentes? *</label>
                    @error('funcionario.possui_dependentes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Lista de dependentes (condicional) --}}
        @if(($funcionario['possui_dependentes'] ?? false) == '1')
            <div class="mt-4">
                @forelse($dependentes as $index => $dependente)
                    @include('livewire.funcionario.partials.dependente-card', ['index' => $index, 'dependente' => $dependente])
                @empty
                    @include('livewire.funcionario.partials.dependentes-empty')
                @endforelse
            </div>
        @endif
    </div>
</section>