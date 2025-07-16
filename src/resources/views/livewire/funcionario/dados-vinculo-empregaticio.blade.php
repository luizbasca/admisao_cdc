<!-- Múltiplos Vínculos -->
<section class="card section-card" data-section="8">
    <div class="section-header">
        <i class="bi bi-person-fill"></i>
        <h2 class="h4 mb-0">Trabalho em Outra Empresa</h2>
    </div>
    <div class="card-body">
        <div class="row g-3">

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
                               class="form-control @error('funcionario.salario_outra_empresa') is-invalid @enderror"
                               wire:model.live="funcionario.salario_outra_empresa"
                               placeholder="Salário">
                        <label>Salário na empresa *</label>
                        @error('funcionario.salario_outra_empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>