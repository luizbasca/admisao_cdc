<div class="form-floating">
    <select class="form-select @error('funcionario.deficiencia') is-invalid @enderror" 
            wire:model.live.debounce.500ms="funcionario.deficiencia">
        <option value="">Selecione...</option>
        @foreach($this->tiposDeficiencia as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <label>Deficiência *</label>
    @error('funcionario.deficiencia') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>