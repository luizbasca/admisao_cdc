<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário - {{ $funcionario->nome }}</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 11px;
        line-height: 1.3;
        color: #333;
        margin: 0;
        padding: 15px;
    }
    
    .header {
        text-align: center;
        border-bottom: 2px solid #007bff;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    
    .header h1 {
        color: #007bff;
        font-size: 20px;
        margin: 0 0 8px 0;
    }
    
    .header p {
        margin: 3px 0;
        color: #666;
        font-size: 10px;
    }
    
    .section {
        margin-bottom: 15px;
        page-break-inside: avoid;
    }
    
    .section-title {
        background-color: #007bff;
        color: white;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 8px;
    }
    
    /* Layout em duas colunas para otimizar espaço */
    .two-columns {
        display: table;
        width: 100%;
        table-layout: fixed;
    }
    
    .column {
        display: table-cell;
        width: 50%;
        padding-right: 15px;
        vertical-align: top;
    }
    
    .column:last-child {
        padding-right: 0;
    }
    
    .info-grid {
        width: 100%;
    }
    
    .info-row {
        margin-bottom: 4px;
        display: flex;
        align-items: baseline;
    }
    
    .info-label {
        font-weight: bold;
        color: #555;
        min-width: 120px;
        margin-right: 8px;
        font-size: 10px;
    }
    
    .info-value {
        flex: 1;
        border-bottom: 1px dotted #ccc;
        padding-bottom: 1px;
        font-size: 11px;
    }
    
    /* Seções compactas em linha */
    .inline-section {
        display: inline-block;
        width: 48%;
        margin-right: 4%;
        vertical-align: top;
    }
    
    .inline-section:nth-child(even) {
        margin-right: 0;
    }
    
    .dependente-card {
        border: 1px solid #ddd;
        padding: 8px;
        margin-bottom: 8px;
        background-color: #f9f9f9;
        font-size: 10px;
    }
    
    .dependente-title {
        font-weight: bold;
        color: #007bff;
        margin-bottom: 5px;
        font-size: 11px;
    }
    
    .badge {
        background-color: #007bff;
        color: white;
        padding: 2px 5px;
        border-radius: 3px;
        font-size: 9px;
        font-weight: bold;
    }
    
    .badge.success {
        background-color: #28a745;
    }
    
    .badge.danger {
        background-color: #dc3545;
    }
    
    /* LGPD compacto */
    .lgpd-compact {
        border: 1px solid #ddd;
        padding: 10px;
        background-color: #f9f9f9;
        font-size: 9px;
        line-height: 1.2;
    }
    
    .lgpd-compact p {
        margin: 5px 0;
    }
    
    .lgpd-compact ul {
        margin: 5px 0;
        padding-left: 15px;
    }
    
    .signature-area {
        margin-top: 20px;
        text-align: center;
    }
    
    .signature-line {
        border-bottom: 1px solid #333;
        width: 300px;
        height: 40px;
        margin: 0 auto 10px;
    }
    
    .footer {
        position: fixed;
        bottom: 15px;
        left: 15px;
        right: 15px;
        text-align: center;
        font-size: 9px;
        color: #666;
        border-top: 1px solid #ddd;
        padding-top: 8px;
    }
    
    @page {
        margin: 1.5cm;
        size: A4;
    }
    
    /* Quebras de página estratégicas */
    .page-break-before {
        page-break-before: always;
    }
    
    .no-break {
        page-break-inside: avoid;
    }
    </style>
</head>
<body>
    <!-- Header compacto -->
    <div class="header">
        <h1>CADASTRO DE FUNCIONÁRIO</h1>
        <p><strong>Sistema E-Social</strong> | Gerado em: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <!-- Dados Pessoais e Documento em duas colunas -->
    <div class="two-columns">
        <div class="column">
            <div class="section">
                <div class="section-title">DADOS PESSOAIS</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Nome:</div>
                        <div class="info-value">{{ $funcionario->nome }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">CPF:</div>
                        <div class="info-value">{{ $funcionario->cpf_formatado }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Nascimento:</div>
                        <div class="info-value">{{ $funcionario->data_nascimento->format('d/m/Y') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Gênero:</div>
                        <div class="info-value">{{ $funcionario->getGeneroFormatado() }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Estado Civil:</div>
                        <div class="info-value">{{ $funcionario->getEstadoCivilFormatado() }}</div>
                    </div>
                    @if($funcionario->escolaridade)
                    <div class="info-row">
                        <div class="info-label">Escolaridade:</div>
                        <div class="info-value">{{ $funcionario->getEscolaridadeFormatada() }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="column">
            <div class="section">
                <div class="section-title">DOCUMENTO</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Tipo:</div>
                        <div class="info-value">{{ $funcionario->getTipoDocumentoFormatado() }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Número:</div>
                        <div class="info-value">{{ $funcionario->numero_documento }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Órgão:</div>
                        <div class="info-value">{{ $funcionario->orgao_emissor }}</div>
                    </div>
                    @if($funcionario->data_emissao)
                    <div class="info-row">
                        <div class="info-label">Emissão:</div>
                        <div class="info-value">{{ $funcionario->data_emissao->format('d/m/Y') }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Endereço -->
    <div class="section">
        <div class="section-title">ENDEREÇO</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Endereço:</div>
                <div class="info-value">{{ $funcionario->rua }}, {{ $funcionario->numero }}{{ $funcionario->complemento ? ', ' . $funcionario->complemento : '' }} - {{ $funcionario->bairro }} - {{ $funcionario->cidade }}/{{ $funcionario->estado }} - CEP: {{ $funcionario->cep_formatado }}</div>
            </div>
        </div>
    </div>

    <!-- Seções menores em linha -->
    <div class="inline-section">
        <div class="section">
            <div class="section-title">SINDICAL</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Você é filiado a algum sindicato?</div>
                    <div class="info-value">{{ $funcionario->filiado_sindicato ? 'Sim' : 'Não' }}</div>
                </div>
                @if($funcionario->filiado_sindicato && $funcionario->nome_sindicato)
                <div class="info-row">
                    <div class="info-label">Sindicato:</div>
                    <div class="info-value">{{ $funcionario->nome_sindicato }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="inline-section">
        <div class="section">
            <div class="section-title">OUTRA EMPRESA</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Está trabalhando em outra empresa?</div>
                    <div class="info-value">{{ $funcionario->trabalhando_outra_empresa ? 'Sim' : 'Não' }}</div>
                </div>
                @if($funcionario->trabalhando_outra_empresa && $funcionario->nome_outra_empresa)
                <div class="info-row">
                    <div class="info-label">Empresa:</div>
                    <div class="info-value">{{ $funcionario->nome_outra_empresa }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Dependentes - sempre mostrar -->
    <div class="section">
        <div class="section-title">DEPENDENTES</div>
        
        @if($funcionario->possui_dependentes && $funcionario->dependentes->count() > 0)
            <div style="margin-bottom: 8px;">
                <strong>Possui dependentes?</strong> 
                <span class="badge success">SIM</span>
                <strong style="margin-left: 15px;">Total:</strong> {{ $funcionario->dependentes->count() }}
            </div>
            
            @foreach($funcionario->dependentes as $index => $dependente)
            <div class="dependente-card">
                <div class="dependente-title">{{ $index + 1 }}. {{ $dependente->nome_completo }}</div>
                <strong>Nasc:</strong> {{ $dependente->data_nascimento->format('d/m/Y') }} ({{ $dependente->getIdade() }} anos) | 
                <strong>Tipo:</strong> {{ $dependente->getTipoDependenciaFormatada() }} | 
                <strong>IR:</strong> {{ $dependente->getDependenteIrFormatado() }} | 
                <strong>Sal.Fam:</strong> {{ $dependente->getDependenteSalarioFamiliaFormatado() }}
                @if($dependente->cpf)
                <br><strong>CPF:</strong> {{ $dependente->cpf_formatado }}
                @endif
            </div>
            @endforeach
        @else
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Possui dependentes?</div>
                    <div class="info-value">
                        <span class="badge danger">NÃO</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Dados de Estrangeiro -->
    <div class="section">
        <div class="section-title">ESTRANGEIRO</div>
        
        @if($funcionario->eh_estrangeiro)
            <div class="two-columns">
                <div class="column">
                    <div class="info-grid">
                        <div class="info-row">
                            <div class="info-label">É Estrangeiro:</div>
                            <div class="info-value">
                                <span class="badge success">SIM</span>
                            </div>
                        </div>
                        @if($funcionario->pais_origem)
                        <div class="info-row">
                            <div class="info-label">País:</div>
                            <div class="info-value">{{ $funcionario->pais_origem }}</div>
                        </div>
                        @endif
                        @if($funcionario->tipo_visto)
                        <div class="info-row">
                            <div class="info-label">Tipo Visto:</div>
                            <div class="info-value">{{ $funcionario->tipo_visto }}</div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="column">
                    <div class="info-grid">
                        @if($funcionario->data_chegada_brasil)
                        <div class="info-row">
                            <div class="info-label">Chegada:</div>
                            <div class="info-value">{{ $funcionario->data_chegada_brasil->format('d/m/Y') }}</div>
                        </div>
                        @endif
                        <div class="info-row">
                            <div class="info-label">Casado BR:</div>
                            <div class="info-value">{{ $funcionario->casado_brasileiro ? 'Sim' : 'Não' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Filhos BR:</div>
                            <div class="info-value">{{ $funcionario->filhos_brasileiros ? 'Sim' : 'Não' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Você é estrangeiro?</div>
                    <div class="info-value">
                        <span class="badge danger">NÃO</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- LGPD compacto -->
    <div class="section no-break">
        <div class="section-title">TERMO LGPD</div>
        <div class="lgpd-compact">
            <p><strong>CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS</strong></p>
            <p>Declaro ciência de que os dados coletados serão utilizados para elaboração do contrato de trabalho e cumprimento de obrigações legais perante órgãos como Receita Federal, INSS, eSocial, bancos e demais instituições necessárias ao vínculo empregatício.</p>
            <p><strong>Compartilhamento:</strong> Autorizo o compartilhamento com prestadores de serviços contratados pela empresa para cumprimento das finalidades legais.</p>
            <p><strong>Prazo:</strong> Dados armazenados durante o vínculo e por até 2 anos após encerramento, conforme LGPD.</p>
            
            <div style="margin-top: 10px;">
                <strong>Status:</strong> 
                <span class="badge {{ $funcionario->concordancia_lgpd ? 'success' : 'danger' }}">
                    {{ $funcionario->concordancia_lgpd ? 'CONCORDOU' : 'NÃO CONCORDOU' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Observações (se houver) -->
    @if($funcionario->observacao)
    <div class="section">
        <div class="section-title">OBSERVAÇÕES</div>
        <div class="info-value" style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;">
            {{ $funcionario->observacao }}
        </div>
    </div>
    @endif

    <!-- Assinatura compacta -->
    <div class="signature-area no-break">
        <p><strong>ASSINATURA DO FUNCIONÁRIO:</strong></p>
        <div class="signature-line"></div>
        <p style="font-size: 10px; margin: 0;">
            <strong>{{ $funcionario->nome }}</strong> - CPF: {{ $funcionario->cpf_formatado }}<br>
            Data: ___/___/____ | Local: ________________
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Sistema E-Social - Cadastro de Funcionários | {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>