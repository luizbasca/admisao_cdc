<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('funcionarios.index') }}">
            <i class="bi bi-building me-2"></i>
            Sistema E-Social
        </a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('funcionarios.index') }}">
                <i class="bi bi-list me-1"></i>Funcionários
            </a>
            <a class="nav-link" href="{{ route('funcionarios.create') }}">
                <i class="bi bi-person-plus me-1"></i>Novo Cadastro
            </a>
        </div>
    </div>
</nav>