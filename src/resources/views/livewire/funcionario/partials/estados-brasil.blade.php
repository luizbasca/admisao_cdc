<div class="form-floating">
    <select class="form-select @error('funcionario.estado') is-invalid @enderror" 
            wire:model="funcionario.estado">
        <option value="">Selecione o estado...</option>
        @foreach($estadosBrasil as $sigla => $nome)
            <option value="{{ $sigla }}">{{ $nome }} ({{ $sigla }})</option>
        @endforeach
    </select>
    <label>Estado *</label>
    @error('funcionario.estado') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>