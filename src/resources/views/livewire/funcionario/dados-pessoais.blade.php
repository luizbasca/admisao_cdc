<!-- Dados do Funcionário -->
<section class="card section-card" data-section="1">
    <div class="section-header">
        <i class="bi bi-person-fill"></i>
        <h2 class="h4 mb-0">Dados do Funcionário</h2>
    </div>
    <div class="card-body">
        <div class="row g-3">
            {{-- Nome Completo --}}
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.nome') is-invalid @enderror" 
                           wire:model.live.debounce.500ms="funcionario.nome" 
                           placeholder="Nome completo">
                    <label>Nome completo *</label>
                    @error('funcionario.nome') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="form-text">Digite o nome completo sem abreviações</div>
            </div>
            
            {{-- CPF --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.cpf') is-invalid @enderror" 
                           wire:model.live.debounce.500ms="funcionario.cpf" 
                           x-mask="999.999.999-99" 
                           placeholder="000.000.000-00">
                    <label>CPF *</label>
                    @error('funcionario.cpf') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Data de Nascimento --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" 
                           class="form-control @error('funcionario.data_nascimento') is-invalid @enderror" 
                           wire:model.live.debounce.500ms="funcionario.data_nascimento">
                    <label>Data de nascimento *</label>
                    @error('funcionario.data_nascimento') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- País de Nascimento --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.pais_nascimento') is-invalid @enderror" 
                           wire:model.live.debounce.500ms="funcionario.pais_nascimento">
                    <label>País de nascimento *</label>
                    @error('funcionario.pais_nascimento') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Gênero --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select @error('funcionario.genero') is-invalid @enderror" 
                            wire:model.live.debounce.500ms="funcionario.genero">
                        <option value="">Selecione...</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                    </select>
                    <label>Gênero *</label>
                    @error('funcionario.genero') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Estado Civil --}}
            <div class="col-md-6">
                @include('livewire.funcionario.partials.estado-civil')
            </div>

            {{-- Raça e Cor --}}
            <div class="col-md-6">
                @include('livewire.funcionario.partials.raca-cor')
            </div>

            {{-- Escolaridade --}}
            <div class="col-md-6">
                @include('livewire.funcionario.partials.escolaridade')
            </div>

            {{-- Deficiência --}}
            <div class="col-md-6">
                @include('livewire.funcionario.partials.deficiencia')
            </div>
        </div>
    </div>
</section>