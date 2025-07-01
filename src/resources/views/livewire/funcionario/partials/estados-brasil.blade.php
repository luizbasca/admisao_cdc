<div class="form-floating">
    <select class="form-select @error('funcionario.estado') is-invalid @enderror" 
            wire:model.live.debounce.500ms="funcionario.estado">
        <option value="">Selecione o estado...</option>
        @foreach($this->estadosBrasil as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <label>Estado *</label>
    @error('funcionario.estado') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>