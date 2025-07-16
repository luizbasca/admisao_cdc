{{-- resources/views/livewire/funcionario/partials/estado-civil.blade.php --}}
<div class="form-floating">
    <select class="form-select @error('funcionario.estado_civil') is-invalid @enderror" 
            wire:model.live.debounce.500ms="funcionario.estado_civil">
        <option value="">Selecione...</option>
        <option value="solteiro">Solteiro</option>
        <option value="casado">Casado</option>
        <option value="divorciado">Divorciado</option>
        <option value="viuvo">Viúvo</option>
        <option value="uniao_estavel">União Estável</option>
    </select>
    <label>Estado Civil *</label>
    @error('funcionario.estado_civil') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>