<div class="form-floating">
    <select class="form-select @error('funcionario.escolaridade') is-invalid @enderror" 
            wire:model.live.debounce.500ms="funcionario.escolaridade">
        <option value="">Selecione...</option>
        @foreach($this->escolaridades as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <label>Escolaridade *</label>
    @error('funcionario.escolaridade') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>