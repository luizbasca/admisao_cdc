<div class="card mb-4">
    <div class="card-header">
        <h5>Documento de Identificação</h5>
    </div>
    <div class="card-body">

        <div class="row g-3">
            {{-- Tipo de Documento --}}
            <div class="col-12">
                @include('livewire.funcionario.partials.tipo-documento')
            </div>

            {{-- Número do Documento --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.numero_documento') is-invalid @enderror" 
                           wire:model="funcionario.numero_documento" 
                           placeholder="Número">
                    <label>Número do Documento *</label>
                    @error('funcionario.numero_documento') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Órgão Emissor --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.orgao_emissor') is-invalid @enderror" 
                           wire:model="funcionario.orgao_emissor" 
                           placeholder="Órgão">
                    <label>Órgão Emissor *</label>
                    @error('funcionario.orgao_emissor') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Data de Emissão --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" 
                           class="form-control @error('funcionario.data_emissao') is-invalid @enderror" 
                           wire:model="funcionario.data_emissao">
                    <label>Data de Emissão</label>
                    @error('funcionario.data_emissao') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Data de Validade --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" 
                           class="form-control @error('funcionario.data_validade') is-invalid @enderror" 
                           wire:model="funcionario.data_validade">
                    <label>Data de Validade</label>
                    @error('funcionario.data_validade') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Informações Adicionais --}}
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" 
                              wire:model="funcionario.info_adicionais" 
                              style="height: 100px" 
                              placeholder="Informações"></textarea>
                    <label>Informações Adicionais</label>
                </div>
            </div>
        </div>
    </div>
</div>