<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário - {{ $funcionario->nome }}</title>

    <!-- Vite Assets -->
    @vite(['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
    
    <style>

    body {
        background: #ffffff;
        font-family: Inter, Segoe UI, system-ui, -apple-system, sans-serif;
        color: #343a40;
        line-height: 1.6;
    }

    /* Cabeçalho com logo e título */
    .header {
        display: block;
        margin-bottom: 25px;
        border-bottom: 3px solid #3498db;
        padding-bottom: 15px;
        text-align: right;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px;
        border-radius: 8px 8px 0 0;
    }

    .header h1 {
        margin: 0;
        padding-top: 20px;
        font-size: 22px;
        color: #2980b9;
        font-weight: bold;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    /* Seções do formulário */
    .section {
        margin-bottom: 15px;
        border: 1px solid #bdc3c7;
        border-radius: 8px;
        padding: 5px;
        page-break-inside: avoid;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .section-title {
        font-size: 16px;
        color: #34495e;
        border-bottom: 2px solid #3498db;
        padding-bottom: 1px;
        margin-bottom: 1px;
        font-weight: bold;
        background: linear-gradient(90deg, #3498db, #2980b9);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .badge.success {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        color: #ffffff;
        border: none;
        box-shadow: 0 2px 4px rgba(39, 174, 96, 0.3);
    }
    .badge.danger {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: #ffffff;
        border: none;
        box-shadow: 0 2px 4px rgba(231, 76, 60, 0.3);
    }

    /* Assinatura */
    .signature-area {
        margin-top: 30px;
        page-break-inside: avoid;
        background: linear-gradient(135deg, #f8f9fa 0%, #ecf0f1 100%);
        padding: 20px;
        border-radius: 8px;
        border: 2px dashed #95a5a6;
    }
    .signature-line {
        border-bottom: 2px solid #34495e;
        width: 300px;
        height: 40px;
        margin: 20px 0 10px 0;
    }

    /* Footer */
    .footer {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 2px solid #3498db;
        text-align: center;
        font-size: 10px;
        color: #7f8c8d;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 15px;
        border-radius: 0 0 8px 8px;
    }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>CADASTRO DE FUNCIONÁRIO</h1>
            <p><strong>Sistema E-Social</strong> | Gerado em: {{ date('d/m/Y H:i:s') }}</p>
        </div>

        <!-- Dados Pessoais  -->
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <div class="section-title">DADOS PESSOAIS</div>
                    <div class="data-field">
                        <strong>Nome:</strong>
                        {{ $funcionario->nome }}
                    </div>
                    <div class="data-field">
                        <strong>CPF:</strong>
                        {{ $funcionario->cpf_formatado }}
                    </div>
                    <div class="data-field">
                        <strong>Nascimento:</strong>
                        {{ $funcionario->data_nascimento->format('d/m/Y') }}
                    </div>
                    <div class="data-field">
                        <strong>País Nascimento:</strong>
                        {{ $funcionario->pais_nascimento ?? 'Brasil' }}
                    </div>
                    <div class="data-field">
                        <strong>Gênero:</strong>
                        {{ $funcionario->getGeneroFormatado() }}
                    </div>
                    <div class="data-field">
                        <strong>Estado Civil:</strong>
                        {{ $funcionario->getEstadoCivilFormatado() }}
                    </div>
                    <div class="data-field">
                        <strong>Raça/Cor:</strong>
                        {{ $funcionario->getRacaCorFormatada() }}
                    </div>
                    <div class="data-field">
                        <strong>Escolaridade:</strong>
                        {{ $funcionario->getEscolaridadeFormatada() }}
                    </div>
                    <div class="data-field">
                        <strong>Deficiência:</strong>
                        {{ $funcionario->getDeficienciaFormatada() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Documento -->
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <div class="section-title">DOCUMENTO</div>
                    <div class="data-field">
                        <strong>Tipo:</strong>
                        {{ $funcionario->getTipoDocumentoFormatado() }}
                    </div>
                    <div class="data-field">
                        <strong>Número:</strong>
                        {{ $funcionario->numero_documento }}
                    </div>
                    <div class="data-field">
                        <strong>Órgão:</strong>
                        {{ $funcionario->orgao_emissor }}
                    </div>
                    @if($funcionario->data_emissao)
                    <div class="data-field">
                        <strong>Emissão:</strong>
                        {{ $funcionario->data_emissao->format('d/m/Y') }}
                    </div>
                    @endif
                    @if($funcionario->data_validade)
                    <div class="data-field">
                        <strong>Validade:</strong>
                        {{ $funcionario->data_validade->format('d/m/Y') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <div class="section-title">ENDEREÇO</div>
                    <div class="data-field">
                        <strong>Endereço Completo:</strong>
                        {{ $funcionario->rua }}, {{ $funcionario->numero }}{{ $funcionario->complemento ? ', ' . $funcionario->complemento : '' }} - {{ $funcionario->bairro }} - {{ $funcionario->cidade }}/{{ $funcionario->estado }} - CEP: {{ $funcionario->cep_formatado }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sindical e Outra Empresa -->
        <div class="row">
            <div class="col-6">
                <div class="section">
                    <div class="section-title">SINDICAL</div>
                    <div class="data-field">
                        <strong>Filiado a sindicato:</strong>
                        {{ $funcionario->filiado_sindicato ? 'Sim' : 'Não' }}
                    </div>
                    @if($funcionario->filiado_sindicato && $funcionario->nome_sindicato)
                    <div class="data-field">
                        <strong>Sindicato:</strong>
                        {{ $funcionario->nome_sindicato }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-6">
                <div class="section">
                    <div class="section-title">OUTRA EMPRESA</div>
                    <div class="data-field">
                        <strong>Trabalha em outra empresa:</strong>
                        {{ $funcionario->trabalhando_outra_empresa ? 'Sim' : 'Não' }}
                    </div>
                    @if($funcionario->trabalhando_outra_empresa && $funcionario->nome_outra_empresa)
                    <div class="data-field">
                        <strong>Empresa:</strong>
                        {{ $funcionario->nome_outra_empresa }}
                    </div>
                    @endif
                    @if($funcionario->trabalhando_outra_empresa && $funcionario->salario_outra_empresa)
                    <div class="data-field">
                        <strong>Salário:</strong>
                        R$ {{ number_format($funcionario->salario_outra_empresa, 2, ',', '.') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Dependentes -->
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <div class="section-title">DEPENDENTES</div>
                    
                    @if($funcionario->possui_dependentes && $funcionario->dependentes->count() > 0)
                        <div class="data-field">
                            <strong>Possui dependentes:</strong> 
                            <span class="badge success">Sim</span>
                            <strong style="margin-left: 15px;">Total:</strong> {{ $funcionario->dependentes->count() }}
                        </div>
                        
                        @foreach($funcionario->dependentes as $index => $dependente)
                        <div class="dependente-card">
                            <div class="dependente-title">{{ $index + 1 }}. {{ $dependente->nome_completo }}</div>
                            <strong>Nascimento:</strong> {{ $dependente->data_nascimento->format('d/m/Y') }} ({{ $dependente->getIdade() }} anos) | 
                            <strong>Tipo:</strong> {{ $dependente->getTipoDependenciaFormatada() }}
                            @if($dependente->cpf)
                            <br><strong>CPF:</strong> {{ $dependente->cpf_formatado }}
                            @endif
                            @if($dependente->dependente_ir)
                            <br><strong>IR:</strong> {{ $dependente->getDependenteIrFormatado() }}
                            @endif
                            @if($dependente->dependente_salario_familia)
                            | <strong>Salário Família:</strong> {{ $dependente->getDependenteSalarioFamiliaFormatado() }}
                            @endif
                            @if($dependente->dependente_plano_saude)
                            | <strong>Plano Saúde:</strong> {{ $dependente->getDependentePlanoSaudeFormatado() }}
                            @endif
                        </div>
                        @endforeach
                    @else
                        <div class="data-field">
                            <strong>Possui dependentes:</strong>
                            <span class="badge danger">Não</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Dados de Estrangeiro -->
        <div class="row">
            <div class="col-12">
                <div class="section">
                    <div class="section-title">ESTRANGEIRO</div>
                    
                    @if($funcionario->eh_estrangeiro)
                        <div class="row">
                            <div class="col-6">
                                <div class="data-field">
                                    <strong>É estrangeiro:</strong>
                                    <span class="badge success">Sim</span>
                                </div>
                                @if($funcionario->pais_origem)
                                <div class="data-field">
                                    <strong>País de Origem:</strong>
                                    {{ $funcionario->pais_origem }}
                                </div>
                                @endif
                                @if($funcionario->tipo_visto)
                                <div class="data-field">
                                    <strong>Tipo de Visto:</strong>
                                    {{ $funcionario->tipo_visto }}
                                </div>
                                @endif
                            </div>
                            <div class="col-6">
                                @if($funcionario->data_chegada_brasil)
                                <div class="data-field">
                                    <strong>Data de Chegada ao Brasil:</strong>
                                    {{ $funcionario->data_chegada_brasil->format('d/m/Y') }}
                                </div>
                                @endif
                                <div class="data-field">
                                    <strong>Casado com Brasileiro:</strong>
                                    {{ $funcionario->casado_brasileiro ? 'Sim' : 'Não' }}
                                </div>
                                <div class="data-field">
                                    <strong>Possui Filhos Brasileiros:</strong>
                                    {{ $funcionario->filhos_brasileiros ? 'Sim' : 'Não' }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="data-field">
                            <strong>É estrangeiro:</strong>
                            <span class="badge danger">Não</span>
                        </div>
                    @endif
                </div>

                <!-- Observações -->
                @if($funcionario->observacao)
                <div class="section">
                    <div class="section-title">OBSERVAÇÕES</div>
                    <div style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 4px;">
                        {{ $funcionario->observacao }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- LGPD -->
        <div class="row">
            <div class="col-12">
                <div class="section no-break">
                    <div class="section-title">TERMO LGPD</div>
                    <div class="lgpd-compact">
                        <p><strong>CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS</strong></p>
                        <p>Declaro ciência de que os dados coletados serão utilizados para elaboração do contrato de trabalho e cumprimento de obrigações legais perante órgãos como Receita Federal, INSS, eSocial, bancos e demais instituições necessárias ao vínculo empregatício.</p>
                        <p><strong>Compartilhamento:</strong> Autorizo o compartilhamento com prestadores de serviços contratados pela empresa para cumprimento das finalidades legais.</p>
                        <p><strong>Prazo:</strong> Dados armazenados durante o vínculo e por até 2 anos após encerramento, conforme LGPD.</p>
                        
                        <div class="data-field">
                            <strong>Status do Consentimento:</strong> 
                            <span class="badge {{ $funcionario->concordancia_lgpd ? 'success' : 'danger' }}">
                                {{ $funcionario->concordancia_lgpd ? 'CONCORDOU' : 'NÃO CONCORDOU' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assinatura -->
        <div class="row">
            <div class="col-12">
                <div class="signature-area no-break">
                    <p><strong>ASSINATURA DO FUNCIONÁRIO:</strong></p>
                    <div class="signature-line"></div>
                    <p style="font-size: 10px; margin: 0;">
                        <strong>{{ $funcionario->nome }}</strong> - CPF: {{ $funcionario->cpf_formatado }}<br>
                        Data: ___/___/____ | Local: ________________
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Sistema E-Social - Cadastro de Funcionários | {{ date('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>