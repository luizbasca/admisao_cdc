{{-- resources/views/funcionarios/partials/endereco.blade.php --}}
<div class="card section-card">
    <div class="section-header">
        <i class="bi bi-geo-alt-fill text-success"></i>
        <h2 class="h4 mb-0">Endereço</h2>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-8">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Logradouro',
                    'value' => $funcionario->getEnderecoCompleto()
                ])
            </div>
            
            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Bairro',
                    'value' => $funcionario->bairro
                ])
            </div>
            
            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Cidade',
                    'value' => $funcionario->cidade
                ])
            </div>
            
            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Estado',
                    'value' => $funcionario->estado
                ])
            </div>
            
            <div class="col-md-4">
                @include('funcionarios.partials.info-item', [
                    'label' => 'CEP',
                    'value' => $funcionario->cep_formatado,
                    'type' => 'code'
                ])
            </div>
        </div>
    </div>
</div>