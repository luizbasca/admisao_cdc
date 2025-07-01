<div class="form-floating">
    <select class="form-select @error('funcionario.tipo_documento') is-invalid @enderror" 
            wire:model="funcionario.tipo_documento">
        <option value="">Selecione o tipo de documento...</option>
        @foreach($this->tiposDocumento as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <label>Tipo de Documento *</label>
    @error('funcionario.tipo_documento') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>

{{-- Informação adicional baseada no tipo de documento --}}
@if($funcionario['tipo_documento'])
    <div class="form-text mt-2">
        @switch($funcionario['tipo_documento'])
            @case('rg')
                <i class="bi bi-info-circle me-1"></i>
                Informe o número do RG sem pontos ou traços.
                @break
            @case('cnh')
                <i class="bi bi-info-circle me-1"></i>
                Informe o número da CNH (11 dígitos).
                @break
            @case('ctps')
                <i class="bi bi-info-circle me-1"></i>
                Informe número e série da Carteira de Trabalho.
                @break
            @case('passaporte')
                <i class="bi bi-info-circle me-1"></i>
                Informe o número do passaporte.
                @break
            @default
                <i class="bi bi-info-circle me-1"></i>
                Informe o número do documento selecionado.
        @endswitch
    </div>
@endif