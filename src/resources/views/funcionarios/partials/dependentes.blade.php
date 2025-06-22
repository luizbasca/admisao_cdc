{{-- resources/views/funcionarios/partials/dependentes.blade.php --}}
<div class="card section-card">
    <div class="section-header">
        <i class="bi bi-people-fill text-warning"></i>
        <h2 class="h4 mb-0">Dependentes ({{ $funcionario->dependentes->count() }})</h2>
    </div>
    <div class="card-body">
        @forelse($funcionario->dependentes as $dependente)
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card border h-100">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="bi bi-person me-2"></i>
                                {{ $dependente->nome_completo }}
                            </h6>
                            
                            <div class="row g-2">
                                @if($dependente->cpf)
                                <div class="col-12">
                                    <small class="text-muted">CPF:</small>
                                    <code class="ms-1">{{ $dependente->cpf_formatado }}</code>
                                </div>
                                @endif
                                
                                <div class="col-6">
                                    <small class="text-muted">Nascimento:</small>
                                    <div>{{ $dependente->data_nascimento->format('d/m/Y') }}</div>
                                </div>
                                
                                <div class="col-6">
                                    <small class="text-muted">Tipo:</small>
                                    <div>
                                        <span class="badge bg-primary">
                                            {{ $dependente->getTipoDependenciaFormatado() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-4">
                <i class="bi bi-person-x fs-1"></i>
                <p class="mt-2">Nenhum dependente cadastrado</p>
                <small>Este funcionário não possui dependentes registrados</small>
            </div>
        @endforelse
    </div>
</div>