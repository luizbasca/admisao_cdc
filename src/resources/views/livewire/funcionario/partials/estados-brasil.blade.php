{{-- /srv/dev-disk-by-uuid-5f656e1d-a107-4bc4-8c71-f72f6511769d/CodigoFonte/producao/admisao_cdc/src/resources/views/livewire/funcionario/partials/estados-brasil.blade.php --}}
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