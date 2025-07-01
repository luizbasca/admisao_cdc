<div class="card mb-4">
    <div class="card-header">
        <h5>Vínculo Empregatício</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            {{-- Filiado a Sindicato --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select @error('funcionario.filiado_sindicato') is-invalid @enderror"
                            wire:model.live="funcionario.filiado_sindicato">
                        <option value="">Selecione...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Você é filiado a algum sindicato? *</label>
                    @error('funcionario.filiado_sindicato')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Nome do Sindicato (condicional) --}}
            @if(($funcionario['filiado_sindicato'] ?? false) == '1')
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text"
                               class="form-control @error('funcionario.nome_sindicato') is-invalid @enderror"
                               wire:model.live="funcionario.nome_sindicato"
                               placeholder="Nome do sindicato">
                        <label>Nome do sindicato *</label>
                        @error('funcionario.nome_sindicato')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endif

            {{-- Trabalhando em Outra Empresa --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select @error('funcionario.trabalhando_outra_empresa') is-invalid @enderror"
                            wire:model.live="funcionario.trabalhando_outra_empresa">
                        <option value="">Selecione...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Está trabalhando em outra empresa? *</label>
                    @error('funcionario.trabalhando_outra_empresa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Informações da Outra Empresa (condicional) --}}
            @if(($funcionario['trabalhando_outra_empresa'] ?? false) == '1')
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text"
                               class="form-control @error('funcionario.nome_outra_empresa') is-invalid @enderror"
                               wire:model.live="funcionario.nome_outra_empresa"
                               placeholder="Nome da empresa">
                        <label>Nome da empresa *</label>
                        @error('funcionario.nome_outra_empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text"
                               class="form-control @error('funcionario.cnpj_outra_empresa') is-invalid @enderror"
                               wire:model.live.debounce.500ms="funcionario.cnpj_outra_empresa"
                               x-mask="99.999.999/9999-99"
                               placeholder="00.000.000/0000-00">
                        <label>CNPJ da empresa</label>
                        @error('funcionario.cnpj_outra_empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text"
                               class="form-control @error('funcionario.cargo_outra_empresa') is-invalid @enderror"
                               wire:model.live="funcionario.cargo_outra_empresa"
                               placeholder="Cargo/função">
                        <label>Cargo/Função na empresa</label>
                        @error('funcionario.cargo_outra_empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>