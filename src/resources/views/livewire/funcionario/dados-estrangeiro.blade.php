<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 me-3">Estrangeiro</h5>
            <div class="form-check form-switch">
                <input class="form-check-input"
                    type="checkbox"
                    wire:model.live="funcionario.eh_estrangeiro"
                    id="ehEstrangeiro">
                <label class="form-check-label" for="ehEstrangeiro">
                    É estrangeiro?
                </label>
            </div>
        </div>
    </div>

    @if($funcionario['eh_estrangeiro'] ?? false)
    <div class="card-body">
        <div class="alert alert-warning" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Atenção:</strong> Preencha todos os campos obrigatórios para funcionários estrangeiros.
        </div>

        <div class="row g-3">
            {{-- País de Origem --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text"
                        class="form-control @error('funcionario.pais_origem') is-invalid @enderror"
                        wire:model.live="funcionario.pais_origem"
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
                        wire:model.live="funcionario.tipo_visto">
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
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date"
                        class="form-control @error('funcionario.data_chegada_brasil') is-invalid @enderror"
                        wire:model.live="funcionario.data_chegada_brasil">
                    <label>Data de Chegada no Brasil *</label>
                    @error('funcionario.data_chegada_brasil')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Informações Adicionais --}}
            <div class="col-12">
                <h6 class="border-bottom pb-2 mb-3">Informações Familiares</h6>
                <div class="row g-3">
                    {{-- Casado com Brasileiro --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('funcionario.casado_brasileiro') is-invalid @enderror"
                                wire:model.live="funcionario.casado_brasileiro">
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
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('funcionario.filhos_brasileiros') is-invalid @enderror"
                                wire:model.live="funcionario.filhos_brasileiros">
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
</div>