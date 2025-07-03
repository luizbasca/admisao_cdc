<!-- Estrangeiro -->
<section class="card section-card" data-section="1">
    <div class="section-header">
        <i class="bi bi-person-fill"></i>
        <h2 class="h4 mb-0">Estrangeiro</h2>
        <div class="form-check form-switch">
            <input class="form-check-input"
                type="checkbox"
                wire:model.live.debounce.500ms="funcionario.eh_estrangeiro"
                id="ehEstrangeiro">
            <label class="form-check-label" for="ehEstrangeiro">
                É estrangeiro?
            </label>
        </div>
    </div>
    @if($funcionario['eh_estrangeiro'] ?? false)
    <div class="card-body">

        <div class="row g-3">
            {{-- País de Origem --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text"
                        class="form-control @error('funcionario.pais_origem') is-invalid @enderror"
                        wire:model.live.debounce.500ms="funcionario.pais_origem"
                        placeholder="País">
                    <label>País de Origem *</label>
                    @error('funcionario.pais_origem')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Tipo de Visto --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select @error('funcionario.tipo_visto') is-invalid @enderror"
                        wire:model.live.debounce.500ms="funcionario.tipo_visto">
                        <option value="">Selecione...</option>
                        <option value="permanente">Visto Permanente</option>
                        <option value="temporario">Visto Temporário</option>
                        <option value="trabalho">Visto de Trabalho</option>
                        <option value="refugiado">Refugiado</option>
                        <option value="outros">Outros</option>
                    </select>
                    <label>Tipo de Visto *</label>
                    @error('funcionario.tipo_visto')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Data de Chegada no Brasil --}}
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="date"
                        class="form-control @error('funcionario.data_chegada_brasil') is-invalid @enderror"
                        wire:model.live.debounce.500ms="funcionario.data_chegada_brasil">
                    <label>Data de Chegada no Brasil *</label>
                    @error('funcionario.data_chegada_brasil')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Casado com Brasileiro --}}
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select @error('funcionario.casado_brasileiro') is-invalid @enderror"
                        wire:model.live.debounce.500ms="funcionario.casado_brasileiro">
                        <option value="">Selecione...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Casado(a) com brasileiro(a) *</label>
                    @error('funcionario.casado_brasileiro')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Filhos Brasileiros --}}
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select @error('funcionario.filhos_brasileiros') is-invalid @enderror"
                        wire:model.live.debounce.500ms="funcionario.filhos_brasileiros">
                        <option value="">Selecione...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Possui filhos brasileiros *</label>
                    @error('funcionario.filhos_brasileiros')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
    </div>
    @else
    <div class="card-body">
        <div class="text-center text-muted py-3">
            <i class="bi bi-toggle-off display-4"></i>
            <p class="mt-2">Marque a opção acima se o for estrangeiro</p>
        </div>
    </div>
    @endif
</section>