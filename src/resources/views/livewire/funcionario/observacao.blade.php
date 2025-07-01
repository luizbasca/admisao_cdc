{{-- Observações --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Observações</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <textarea 
                wire:model.model="funcionario.observacao" 
                id="funcionario.observacao" 
                class="form-control @error('funcionario.observacao') is-invalid @enderror" 
                rows="4" 
                placeholder="Inclua aqui informações adicionais que julgar relevantes."
            ></textarea>
            @error('observacao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
