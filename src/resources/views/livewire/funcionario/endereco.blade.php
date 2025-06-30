<div class="card mb-4">
    <div class="card-header">
        <h5>Endereço</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">

            {{-- CEP --}}
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="text" 
                        class="form-control @error('funcionario.cep') is-invalid @enderror" 
                        wire:model.live="funcionario.cep" 
                        x-mask="99999-999" 
                        placeholder="00000-000"
                        maxlength="9">
                    <label>CEP *</label>
                    @error('funcionario.cep') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Logradouro --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.rua') is-invalid @enderror" 
                           wire:model="funcionario.rua" 
                           placeholder="Nome da rua">
                    <label>Logradouro *</label>
                    @error('funcionario.rua') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Número --}}
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.numero') is-invalid @enderror" 
                           wire:model="funcionario.numero" 
                           placeholder="123">
                    <label>Número *</label>
                    @error('funcionario.numero') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Complemento --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control" 
                           wire:model="funcionario.complemento" 
                           placeholder="Complemento">
                    <label>Complemento</label>
                </div>
            </div>

            {{-- Bairro --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.bairro') is-invalid @enderror" 
                           wire:model="funcionario.bairro" 
                           placeholder="Bairro">
                    <label>Bairro *</label>
                    @error('funcionario.bairro') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Cidade --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" 
                           class="form-control @error('funcionario.cidade') is-invalid @enderror" 
                           wire:model="funcionario.cidade" 
                           placeholder="Cidade">
                    <label>Cidade *</label>
                    @error('funcionario.cidade') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Estado --}}
            <div class="col-md-6">
                @include('livewire.funcionario.partials.estados-brasil')
            </div>
        </div>
    </div>
</div>

{{-- Script para melhorar a experiência do usuário --}}
<script>
document.addEventListener('livewire:initialized', () => {
    // Escuta o evento de CEP encontrado
    Livewire.on('cep-encontrado', () => {
        // Foca no campo número após preencher o endereço
        setTimeout(() => {
            document.querySelector('input[wire\\:model="funcionario.numero"]')?.focus();
        }, 100);
    });
});
</script>