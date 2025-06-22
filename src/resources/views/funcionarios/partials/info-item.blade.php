{{-- resources/views/funcionarios/partials/info-item.blade.php --}}
<div class="info-item">
    <label class="fw-bold text-muted">{{ $label }}:</label>
    @if($type ?? null === 'code')
        <p class="mb-0"><code>{{ $value ?? 'Não informado' }}</code></p>
    @elseif($type ?? null === 'badge')
        <p class="mb-0">
            <span class="badge {{ $badgeClass ?? 'bg-secondary' }}">
                {{ $value ?? 'Não informado' }}
            </span>
        </p>
    @else
        <p class="mb-0">{{ $value ?? 'Não informado' }}</p>
    @endif
</div>