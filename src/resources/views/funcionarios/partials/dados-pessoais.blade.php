{{-- resources/views/funcionarios/partials/dados-pessoais.blade.php --}}
<div class="card section-card">
    <div class="section-header">
        <i class="bi bi-person-fill text-primary"></i>
        <h2 class="h4 mb-0">Dados Pessoais</h2>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Nome Completo',
                    'value' => $funcionario->nome_completo
                ])
            </div>
            
            <div class="col-md-3">
                @include('funcionarios.partials.info-item', [
                    'label' => 'CPF',
                    'value' => $funcionario->cpf_formatado,
                    'type' => 'code'
                ])
            </div>
            
            <div class="col-md-3">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Data de Nascimento',
                    'value' => $funcionario->data_nascimento->format('d/m/Y')
                ])
            </div>

            @if($funcionario->pais_nascimento)
            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'País de Nascimento',
                    'value' => $funcionario->pais_nascimento
                ])
            </div>
            @endif

            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Gênero',
                    'value' => ucfirst($funcionario->genero),
                    'type' => 'badge',
                    'badgeClass' => $funcionario->genero == 'masculino' ? 'bg-primary' : 'bg-pink'
                ])
            </div>

            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Estado Civil',
                    'value' => $funcionario->getEstadoCivilFormatado()
                ])
            </div>

            @if($funcionario->raca_cor)
            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Raça/Cor',
                    'value' => ucfirst(str_replace('_', ' ', $funcionario->raca_cor))
                ])
            </div>
            @endif

            @if($funcionario->escolaridade)
            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Escolaridade',
                    'value' => $funcionario->getEscolaridadeFormatada()
                ])
            </div>
            @endif

            @if($funcionario->deficiencia)
            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Deficiência',
                    'value' => $funcionario->getDeficienciaFormatada()
                ])
            </div>
            @endif

            @if($funcionario->obs_deficiencia)
            <div class="col-12">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Observações sobre Deficiência',
                    'value' => $funcionario->obs_deficiencia
                ])
            </div>
            @endif
        </div>
    </div>
</div>