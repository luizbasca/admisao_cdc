<div class="form-floating">
    <select class="form-select @error('funcionario.raca_cor') is-invalid @enderror" 
            wire:model.live.debounce.500ms="funcionario.raca_cor">
        <option value="">Selecione...</option>
        @foreach($this->racasCores as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <label>Raça/Cor *</label>
    @error('funcionario.raca_cor') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>