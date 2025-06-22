{{-- resources/views/funcionarios/partials/documento-identificacao.blade.php --}}
<div class="card section-card">
    <div class="section-header">
        <i class="bi bi-card-text text-info"></i>
        <h2 class="h4 mb-0">Documento de Identificação</h2>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-3">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Tipo',
                    'value' => strtoupper($funcionario->tipo_documento),
                    'type' => 'badge',
                    'badgeClass' => 'bg-info'
                ])
            </div>
            
            <div class="col-md-3">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Número',
                    'value' => $funcionario->numero_documento,
                    'type' => 'code'
                ])
            </div>
            
            <div class="col-md-3">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Órgão Emissor',
                    'value' => $funcionario->orgao_emissor
                ])
            </div>
            
            <div class="col-md-3">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Data de Emissão',
                    'value' => $funcionario->data_emissao?->format('d/m/Y')
                ])
            </div>

            @if($funcionario->data_validade)
            <div class="col-md-3">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Data de Validade',
                    'value' => $funcionario->data_validade->format('d/m/Y')
                ])
            </div>
            @endif

            @if($funcionario->info_adicionais)
            <div class="col-12">
                @include('funcionarios.partials.info-item', [
                    'label' => 'Informações Adicionais',
                    'value' => $funcionario->info_adicionais
                ])
            </div>
            @endif
        </div>
    </div>
</div>