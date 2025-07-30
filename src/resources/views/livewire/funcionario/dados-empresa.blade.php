
<!-- Dados da Empresa -->
<section class="card section-card" data-section="2">
    <div class="section-header">
        <i class="bi bi-building"></i>
        <h2 class="h4 mb-0">Dados da Empresa</h2>
    </div>
    <div class="card-body">
        <div class="row g-3">
            {{-- Nome da Empresa --}}
            <div class="col-md-8">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.nome_empresa') is-invalid @enderror" 
                           wire:model.blur="funcionario.nome_empresa"
                           placeholder="Digite o nome da empresa"
                           maxlength="100">
                    <label>Nome da Empresa *</label>
                    @error('funcionario.nome_empresa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- CNPJ da Empresa --}}
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.cnpj_empresa') is-invalid @enderror" 
                           wire:model.blur="funcionario.cnpj_empresa"
                           x-mask="99.999.999/9999-99"
                           placeholder="00.000.000/0000-00">
                    <label>CNPJ da Empresa *</label>
                    @error('funcionario.cnpj_empresa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</section>