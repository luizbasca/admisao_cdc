<!-- Sindicato -->
<section class="card section-card" data-section="1">
    <div class="section-header">
        <i class="bi bi-person-fill"></i>
        <h2 class="h4 mb-0">Sindicato</h2>
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
        </div>
    </div>
</section>