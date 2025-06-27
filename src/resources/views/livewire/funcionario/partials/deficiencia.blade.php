{{-- /srv/dev-disk-by-uuid-5f656e1d-a107-4bc4-8c71-f72f6511769d/CodigoFonte/producao/admisao_cdc/src/resources/views/livewire/funcionario/partials/deficiencia.blade.php --}}
<div class="form-floating">
    <select class="form-select @error('funcionario.deficiencia') is-invalid @enderror" 
            wire:model="funcionario.deficiencia">
        <option value="">Selecione...</option>
        @foreach($tiposDeficiencia as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <label>Deficiência *</label>
    @error('funcionario.deficiencia') 
        <div class="invalid-feedback">{{ $message }}</div> 
    @enderror
</div>