{{-- Observações --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Observações</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="observacoes" class="form-label">
                Observações Gerais
            </label>
            <textarea 
                wire:model="observacoes" 
                id="observacoes" 
                class="form-control @error('observacoes') is-invalid @enderror" 
                rows="4" 
                placeholder="Inclua aqui informações adicionais que julgar relevantes."
            ></textarea>
            @error('observacoes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
