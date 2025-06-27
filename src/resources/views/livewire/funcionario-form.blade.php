<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="salvar">
        <!-- Dados do Funcionário -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Dados do Funcionário</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('funcionario.nome') is-invalid @enderror" 
                                   wire:model="funcionario.nome" placeholder="Nome completo">
                            <label>Nome completo *</label>
                            @error('funcionario.nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('funcionario.cpf') is-invalid @enderror" 
                                   wire:model="funcionario.cpf" x-mask="999.999.999-99" placeholder="000.000.000-00">
                            <label>CPF *</label>
                            @error('funcionario.cpf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('funcionario.cep') is-invalid @enderror" 
                                   wire:model="funcionario.cep" x-mask="99999-999" placeholder="00000-000">
                            <label>CEP *</label>
                            @error('funcionario.cep') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <!-- Outros campos do endereço -->
                    <div class="col-md-8">
                        <div class="form-floating">
                            <input type="text" class="form-control" wire:model="funcionario.rua" placeholder="Rua">
                            <label>Rua</label>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" wire:model="funcionario.numero" placeholder="Número">
                            <label>Número</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dependentes -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Dependentes</h5>
                <button type="button" class="btn btn-primary" wire:click="adicionarDependente" 
                        @if(count($dependentes) >= $maxDependentes) disabled @endif>
                    <i class="bi bi-plus"></i> Adicionar
                </button>
            </div>
            <div class="card-body">
                @forelse($dependentes as $index => $dependente)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6>Dependente {{ $index + 1 }}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                    wire:click="removerDependente({{ $index }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('dependentes.'.$index.'.nome_completo') is-invalid @enderror" 
                                               wire:model="dependentes.{{ $index }}.nome_completo" placeholder="Nome completo">
                                        <label>Nome completo *</label>
                                        @error('dependentes.'.$index.'.nome_completo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" 
                                               wire:model="dependentes.{{ $index }}.cpf" x-mask="999.999.999-99" placeholder="000.000.000-00">
                                        <label>CPF</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('dependentes.'.$index.'.data_nascimento') is-invalid @enderror" 
                                               wire:model="dependentes.{{ $index }}.data_nascimento">
                                        <label>Data de nascimento *</label>
                                        @error('dependentes.'.$index.'.data_nascimento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select @error('dependentes.'.$index.'.tipo_dependencia') is-invalid @enderror" 
                                                wire:model="dependentes.{{ $index }}.tipo_dependencia">
                                            <option value="">Selecione...</option>
                                            <option value="conjuge">Cônjuge</option>
                                            <option value="filho">Filho(a)</option>
                                            <option value="enteado">Enteado(a)</option>
                                            <option value="menor_tutela">Menor sob tutela</option>
                                            <option value="pais">Pais</option>
                                            <option value="outros">Outros</option>
                                        </select>
                                        <label>Tipo de dependência *</label>
                                        @error('dependentes.'.$index.'.tipo_dependencia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                
                                @if($dependente['tipo_dependencia'] === 'outros')
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" 
                                                   wire:model="dependentes.{{ $index }}.outros_especificar" placeholder="Especificar">
                                            <label>Especificar tipo de dependência</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-people display-4"></i>
                        <p class="mt-2">Nenhum dependente adicionado</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary">Cancelar</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Salvar</span>
                <span wire:loading>
                    <i class="bi bi-hourglass-split me-2"></i>Salvando...
                </span>
            </button>
        </div>
    </form>
</div>