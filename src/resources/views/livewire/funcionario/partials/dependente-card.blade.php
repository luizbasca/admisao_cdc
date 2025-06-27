{{-- /srv/dev-disk-by-uuid-5f656e1d-a107-4bc4-8c71-f72f6511769d/CodigoFonte/producao/admisao_cdc/src/resources/views/livewire/funcionario/partials/dependente-card.blade.php --}}
<div class="card mb-3 border-start border-primary border-3">
    <div class="card-header d-flex justify-content-between align-items-center bg-light">
        <h6 class="mb-0">
            <i class="bi bi-person me-2"></i>
            Dependente {{ $index + 1 }}
        </h6>
        <button type="button" 
                class="btn btn-outline-danger btn-sm" 
                wire:click="removerDependente({{ $index }})"
                wire:confirm="Tem certeza que deseja remover este dependente?">
            <i class="bi bi-trash"></i>
        </button>
    </div>
    <div class="card-body">
        <div class="row g-3">
            {{-- Nome Completo --}}
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('dependentes.'.$index.'.nome_completo') is-invalid @enderror" 
                           wire:model="dependentes.{{ $index }}.nome_completo" 
                           placeholder="Nome completo">
                    <label>Nome Completo *</label>
                    @error('dependentes.'.$index.'.nome_completo') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- CPF --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('dependentes.'.$index.'.cpf') is-invalid @enderror" 
                           wire:model="dependentes.{{ $index }}.cpf" 
                           x-mask="999.999.999-99" 
                           placeholder="000.000.000-00">
                    <label>CPF</label>
                    @error('dependentes.'.$index.'.cpf') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="form-text">Opcional para menores de idade</div>
            </div>

            {{-- Data de Nascimento --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" 
                           class="form-control @error('dependentes.'.$index.'.data_nascimento') is-invalid @enderror" 
                           wire:model="dependentes.{{ $index }}.data_nascimento">
                    <label>Data de Nascimento *</label>
                    @error('dependentes.'.$index.'.data_nascimento') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Tipo de Dependência --}}
            <div class="col-md-8">
                <div class="form-floating">
                    <select class="form-select @error('dependentes.'.$index.'.tipo_dependencia') is-invalid @enderror" 
                            wire:model="dependentes.{{ $index }}.tipo_dependencia">
                        <option value="">Selecione o tipo...</option>
                        @foreach($tiposDependencia as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <label>Tipo de Dependência *</label>
                    @error('dependentes.'.$index.'.tipo_dependencia') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Campo condicional para "Outros" --}}
            @if(isset($dependentes[$index]['tipo_dependencia']) && $dependentes[$index]['tipo_dependencia'] === 'outros')
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" 
                               class="form-control @error('dependentes.'.$index.'.outros_especificar') is-invalid @enderror" 
                               wire:model="dependentes.{{ $index }}.outros_especificar" 
                               placeholder="Especificar">
                        <label>Especificar Outros *</label>
                        @error('dependentes.'.$index.'.outros_especificar') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>