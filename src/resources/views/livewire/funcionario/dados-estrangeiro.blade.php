{{-- /srv/dev-disk-by-uuid-5f656e1d-a107-4bc4-8c71-f72f6511769d/CodigoFonte/producao/admisao_cdc/src/resources/views/livewire/funcionario/dados-estrangeiro.blade.php --}}
<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 me-3">Funcionário Estrangeiro</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" 
                       type="checkbox" 
                       wire:model="funcionario.eh_estrangeiro" 
                       id="ehEstrangeiro">
                <label class="form-check-label" for="ehEstrangeiro">
                    É estrangeiro?
                </label>
            </div>
        </div>
    </div>
    
    @if($funcionario['eh_estrangeiro'])
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
                               wire:model="funcionario.pais_origem" 
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
                                wire:model="funcionario.tipo_visto">
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

                {{-- Número do Visto --}}
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" 
                               class="form-control @error('funcionario.numero_visto') is-invalid @enderror" 
                               wire:model="funcionario.numero_visto" 
                               placeholder="Número">
                        <label>Número do Visto *</label>
                        @error('funcionario.numero_visto') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                {{-- Data de Chegada no Brasil --}}
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" 
                               class="form-control @error('funcionario.data_chegada_brasil') is-invalid @enderror" 
                               wire:model="funcionario.data_chegada_brasil">
                        <label>Data de Chegada no Brasil *</label>
                        @error('funcionario.data_chegada_brasil') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                {{-- Classificação do Trabalhador --}}
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" 
                               class="form-control @error('funcionario.classificacao_trabalhador') is-invalid @enderror" 
                               wire:model="funcionario.classificacao_trabalhador" 
                               placeholder="Classificação">
                        <label>Classificação do Trabalhador Estrangeiro *</label>
                        @error('funcionario.classificacao_trabalhador') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                    <div class="form-text">
                        Ex: Técnico especializado, Executivo, Pesquisador, etc.
                    </div>
                </div>

                {{-- Informações Adicionais --}}
                <div class="col-12">
                    <h6 class="border-bottom pb-2 mb-3">Informações Familiares</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       wire:model="funcionario.casado_brasileiro" 
                                       id="casadoBrasileiro">
                                <label class="form-check-label" for="casadoBrasileiro">
                                    Casado(a) com brasileiro(a)
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       wire:model="funcionario.filhos_brasileiros" 
                                       id="filhosBrasileiros">
                                <label class="form-check-label" for="filhosBrasileiros">
                                    Possui filhos brasileiros
                                </label>
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
                <p class="mt-2">Marque a opção acima se o funcionário for estrangeiro</p>
            </div>
        </div>
    @endif
</div>