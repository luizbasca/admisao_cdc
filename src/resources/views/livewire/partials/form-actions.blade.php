{{-- resources/views/livewire/partials/form-actions.blade.php --}}
<div class="d-flex justify-content-end gap-2">
    <button type="button" class="btn btn-secondary">Cancelar</button>
    <button type="submit" 
            class="btn btn-primary" 
            wire:loading.attr="disabled">
        <span wire:loading.remove>
            <i class="bi bi-check-circle me-2"></i>Salvar
        </span>
        <span wire:loading>
            <i class="bi bi-hourglass-split me-2"></i>Salvando...
        </span>
    </button>
</div>