<!-- Observações -->
<section class="card section-card" data-section="1">
    <div class="section-header">
        <i class="bi bi-person-fill"></i>
        <h2 class="h4 mb-0">Observações</h2>
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
</section>
