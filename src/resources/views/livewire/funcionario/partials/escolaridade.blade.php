{{-- /srv/dev-disk-by-uuid-5f656e1d-a107-4bc4-8c71-f72f6511769d/CodigoFonte/producao/admisao_cdc/src/resources/views/livewire/funcionario/partials/escolaridade.blade.php --}}
<div class="form-floating">
    <select class="form-select @error('funcionario.escolaridade') is-invalid @enderror" 
            wire:model="funcionario.escolaridade">
        <option value="">Selecione...</option>
        @foreach($escolaridades as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <label>Escolaridade *</label>
    @error('funcionario.escolaridade') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>