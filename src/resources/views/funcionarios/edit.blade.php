@extends('layouts.app')

@section('title', 'Editar: ' . $funcionario->nome_completo)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">
            <i class="bi bi-pencil-fill me-2"></i>
            Editar Funcionário
        </h1>
        <p class="text-muted mb-0">{{ $funcionario->nome_completo }}</p>
    </div>
    <a href="{{ route('funcionarios.show', $funcionario) }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Voltar
    </a>
</div>

<form id="editarFuncionario" method="POST" action="{{ route('funcionarios.update', $funcionario) }}" novalidate>
    @csrf
    @method('PUT')

    <!-- Dados do Funcionário -->
    <section class="card section-card">
        <div class="section-header">
            <i class="bi bi-person-fill"></i>
            <h2 class="h4 mb-0">Dados do Funcionário</h2>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('nome_completo') is-invalid @enderror" 
                               id="nomeCompleto" name="nome_completo" placeholder="Nome completo" 
                               required maxlength="100" value="{{ old('nome_completo', $funcionario->nome_completo) }}">
                        <label for="nomeCompleto" class="required-field">Nome completo</label>
                        @error('nome_completo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('cpf') is-invalid @enderror" 
                               id="cpf" name="cpf" placeholder="000.000.000-00" required 
                               data-mask="cpf" value="{{ old('cpf', $funcionario->cpf_formatado) }}">
                        <label for="cpf" class="required-field">CPF</label>
                        @error('cpf')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" 
                               id="dataNascimento" name="data_nascimento" required 
                               value="{{ old('data_nascimento', $funcionario->data_nascimento->format('Y-m-d')) }}">
                        <label for="dataNascimento" class="required-field">Data de nascimento</label>
                        @error('data_nascimento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Continuar com todos os outros campos similar ao create, mas com valores preenchidos -->
                <!-- Por brevidade, mostrando apenas alguns campos principais -->

                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select @error('genero') is-invalid @enderror" 
                                id="genero" name="genero" required>
                            <option value="">Selecione...</option>
                            <option value="masculino" {{ old('genero', $funcionario->genero) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="feminino" {{ old('genero', $funcionario->genero) == 'feminino' ? 'selected' : '' }}>Feminino</option>
                        </select>
                        <label for="genero" class="required-field">Gênero</label>
                        @error('genero')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Adicionar todos os outros campos aqui seguindo o mesmo padrão -->
            </div>
        </div>
    </section>

    <!-- Dependentes Existentes -->
    <section class="card section-card">
        <div class="section-header">
            <i class="bi bi-people-fill"></i>
            <h2 class="h4 mb-0">Dependentes</h2>
        </div>
        <div class="card-body">
            @if($funcionario->dependentes->count() > 0)
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Para editar dependentes, exclua os existentes e adicione novamente.
                </div>
                
                <div class="row g-3 mb-4">
                    @foreach($funcionario->dependentes as $dependente)
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title">{{ $dependente->nome_completo }}</h6>
                                        <small class="text-muted">{{ $dependente->data_nascimento->format('d/m/Y') }}</small>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="excluirDependente({{ $dependente->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- Área para adicionar novos dependentes (similar ao create) -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Adicionar Novos Dependentes</h5>
                <button type="button" class="btn btn-primary btn-sm" id="adicionarDependente">
                    <i class="bi bi-person-plus me-2"></i>Adicionar Dependente
                </button>
            </div>

            <div id="dependentesContainer">
                <!-- Novos dependentes serão adicionados aqui -->
            </div>
        </div>
    </section>

    <!-- Submit Button -->
    <div class="text-center py-4">
        <button type="submit" class="btn btn-success btn-submit">
            <i class="bi bi-check-circle me-2"></i>
            Atualizar Funcionário
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
// Scripts similares ao create, mas adaptados para edição
// Incluir função para excluir dependentes existentes via AJAX

function excluirDependente(id) {
    if (confirm('Tem certeza que deseja excluir este dependente?')) {
        fetch(`/dependentes/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erro ao excluir dependente');
            }
        });
    }
}
</script>
@endpush