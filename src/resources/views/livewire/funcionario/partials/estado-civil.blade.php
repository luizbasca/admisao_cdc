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
        <option value="outros">Outros</option>
    </select>
    <label>Estado Civil *</label>
    @error('funcionario.estado_civil') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>

{{-- Campo condicional para "Outros" --}}
@if($funcionario['estado_civil'] === 'outros')
    <div class="mt-2">
        <div class="form-floating">
            <input type="text" 
                   class="form-control @error('funcionario.outros_estado_texto') is-invalid @enderror" 
                   wire:model.live.debounce.500ms="funcionario.outros_estado_texto" 
                   placeholder="Especificar">
            <label>Especificar outros</label>
            @error('funcionario.outros_estado_texto') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>
    </div>
@endif