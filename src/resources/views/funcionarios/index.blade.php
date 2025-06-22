@extends('layouts.app')

@section('title', 'Lista de Funcionários - Sistema E-Social')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">
            <i class="bi bi-people-fill me-2"></i>
            Funcionários Cadastrados
        </h1>
        <p class="text-muted mb-0">Gerencie os funcionários do sistema E-Social</p>
    </div>
    <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-2"></i>
        Novo Funcionário
    </a>
</div>

@if($funcionarios->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Documento</th>
                            <th>Cidade/UF</th>
                            <th>Dependentes</th>
                            <th>Cadastrado em</th>
                            <th width="200">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($funcionarios as $funcionario)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">#{{ $funcionario->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                        <i class="bi bi-person text-white"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $funcionario->nome_completo }}</div>
                                        <small class="text-muted">{{ ucfirst($funcionario->genero) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <code>{{ $funcionario->cpf_formatado }}</code>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ strtoupper($funcionario->tipo_documento) }}</span>
                                <br>
                                <small class="text-muted">{{ $funcionario->numero_documento }}</small>
                            </td>
                            <td>
                                {{ $funcionario->cidade }}/{{ $funcionario->estado }}
                                <br>
                                <small class="text-muted">{{ $funcionario->cep_formatado }}</small>
                            </td>
                            <td>
                                @if($funcionario->dependentes->count() > 0)
                                    <span class="badge bg-success">{{ $funcionario->dependentes->count() }}</span>
                                @else
                                    <span class="badge bg-secondary">0</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $funcionario->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('funcionarios.show', $funcionario) }}" 
                                       class="btn btn-outline-primary" title="Visualizar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('funcionarios.edit', $funcionario) }}" 
                                       class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('funcionarios.pdf', $funcionario) }}" 
                                       class="btn btn-outline-success" title="Gerar PDF">
                                        <i class="bi bi-file-pdf"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" 
                                            onclick="confirmarExclusao({{ $funcionario->id }})" title="Excluir">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($funcionarios->hasPages())
        <div class="card-footer">
            {{ $funcionarios->links() }}
        </div>
        @endif
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-person-x display-1 text-muted"></i>
        <h3 class="mt-3">Nenhum funcionário cadastrado</h3>
        <p class="text-muted">Comece cadastrando o primeiro funcionário no sistema.</p>
        <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>
            Cadastrar Primeiro Funcionário
        </a>
    </div>
@endif

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                    Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir este funcionário?</p>
                <p class="text-danger"><strong>Esta ação não pode ser desfeita!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }
</style>
@endpush

@push('scripts')
<script>
function confirmarExclusao(id) {
    const form = document.getElementById('deleteForm');
    form.action = `/funcionarios/${id}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endpush