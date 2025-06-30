<div class="form-floating">
    <select class="form-select @error('funcionario.raca_cor') is-invalid @enderror" 
            wire:model="funcionario.raca_cor">
        <option value="">Selecione...</option>
        @foreach($racasCores as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <label>Raça/Cor *</label>
    @error('funcionario.raca_cor') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>

{{-- Campo condicional para "Outros" --}}
@if($funcionario['raca_cor'] === 'outros')
    <div class="mt-2">
        <div class="form-floating">
            <input type="text" 
                   class="form-control @error('funcionario.outros_raca_texto') is-invalid @enderror" 
                   wire:model="funcionario.outros_raca_texto" 
                   placeholder="Especificar">
            <label>Especificar outros</label>
            @error('funcionario.outros_raca_texto') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>
    </div>
@endif