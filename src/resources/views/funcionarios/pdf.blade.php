<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário - {{ $funcionario->nome_completo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .header h1 {
            color: #007bff;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        
        .header p {
            margin: 5px 0;
            color: #666;
        }
        
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-label {
            display: table-cell;
            font-weight: bold;
            color: #555;
            padding: 5px 10px 5px 0;
            width: 30%;
            vertical-align: top;
        }
        
        .info-value {
            display: table-cell;
            padding: 5px 0;
            border-bottom: 1px dotted #ccc;
            vertical-align: top;
        }
        
        .two-column {
            width: 48%;
            float: left;
            margin-right: 4%;
        }
        
        .two-column:last-child {
            margin-right: 0;
        }
        
        .clear {
            clear: both;
        }
        
        .dependente-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        
        .dependente-title {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 8px;
        }
        
        .badge {
            background-color: #007bff;
            color: white;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
        }
        
        .footer {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        @page {
            margin: 2cm;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>CADASTRO DE FUNCIONÁRIO</h1>
        <p><strong>Sistema E-Social</strong></p>
        <p>Gerado em: {{ date('d/m/Y H:i:s') }}</p>
        <p>ID do Funcionário: #{{ $funcionario->id }}</p>
    </div>

    <!-- Dados Pessoais -->
    <div class="section">
        <div class="section-title">DADOS PESSOAIS</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nome Completo:</div>
                <div class="info-value">{{ $funcionario->nome_completo }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">CPF:</div>
                <div class="info-value">{{ $funcionario->cpf_formatado }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Data de Nascimento:</div>
                <div class="info-value">{{ $funcionario->data_nascimento->format('d/m/Y') }}</div>
            </div>
            @if($funcionario->pais_nascimento)
            <div class="info-row">
                <div class="info-label">País de Nascimento:</div>
                <div class="info-value">{{ $funcionario->pais_nascimento }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">Gênero:</div>
                <div class="info-value">{{ ucfirst($funcionario->genero) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Estado Civil:</div>
                <div class="info-value">
                    {{ ucfirst(str_replace('_', ' ', $funcionario->estado_civil)) }}
                    @if($funcionario->estado_civil == 'outros' && $funcionario->outros_estado_texto)
                        ({{ $funcionario->outros_estado_texto }})
                    @endif
                </div>
            </div>
            @if($funcionario->raca_cor)
            <div class="info-row">
                <div class="info-label">Raça/Cor:</div>
                <div class="info-value">{{ ucfirst(str_replace('_', ' ', $funcionario->raca_cor)) }}</div>
            </div>
            @endif
            @if($funcionario->escolaridade)
            <div class="info-row">
                <div class="info-label">Escolaridade:</div>
                <div class="info-value">
                    @php
                        $escolaridades = [
                            '01' => 'Analfabeto',
                            '02' => 'Até 4ª série incompleta (EF)',
                            '03' => '4ª série completa (EF)',
                            '04' => 'De 5ª a 8ª série (EF)',
                            '05' => 'Ensino Fundamental Completo',
                            '06' => 'Ensino Médio Incompleto',
                            '07' => 'Ensino Médio Completo',
                            '08' => 'Ensino Superior Incompleto',
                            '09' => 'Ensino Superior Completo',
                            '10' => 'Pós Graduação',
                            '12' => 'Doutorado',
                            '13' => 'Outros'
                        ];
                    @endphp
                    {{ $escolaridades[$funcionario->escolaridade] ?? 'Não informado' }}
                </div>
            </div>
            @endif
            @if($funcionario->deficiencia)
            <div class="info-row">
                <div class="info-label">Deficiência:</div>
                <div class="info-value">
                    @php
                        $deficiencias = [
                            '01' => 'Não tenho Deficiência',
                            '02' => 'Auditiva',
                            '03' => 'Visual',
                            '04' => 'Intelectual',
                            '05' => 'Mental',
                            '06' => 'Reabilitado'
                        ];
                    @endphp
                    {{ $deficiencias[$funcionario->deficiencia] ?? 'Não informado' }}
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>

    <!-- Documento de Identificação -->
    <div class="section">
        <div class="section-title">DOCUMENTO DE IDENTIFICAÇÃO</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Tipo de Documento:</div>
                <div class="info-value">{{ strtoupper($funcionario->tipo_documento) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Número:</div>
                <div class="info-value">{{ $funcionario->numero_documento }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Órgão Emissor:</div>
                <div class="info-value">{{ $funcionario->orgao_emissor }}</div>
            </div>
            @if($funcionario->data_emissao)
            <div class="info-row">
                <div class="info-label">Data de Emissão:</div>
                <div class="info-value">{{ $funcionario->data_emissao->format('d/m/Y') }}</div>
            </div>
            @endif
            @if($funcionario->data_validade)
            <div class="info-row">
                <div class="info-label">Data de Validade:</div>
                <div class="info-value">{{ $funcionario->data_validade->format('d/m/Y') }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Endereço -->
    <div class="section">
        <div class="section-title">ENDEREÇO</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Logradouro:</div>
                <div class="info-value">{{ $funcionario->rua }}, {{ $funcionario->numero }}</div>
            </div>
            @if($funcionario->complemento)
            <div class="info-row">
                <div class="info-label">Complemento:</div>
                <div class="info-value">{{ $funcionario->complemento }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">Bairro:</div>
                <div class="info-value">{{ $funcionario->bairro }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Cidade/UF:</div>
                <div class="info-value">{{ $funcionario->cidade }}/{{ $funcionario->estado }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">CEP:</div>
                <div class="info-value">{{ $funcionario->cep_formatado }}</div>
            </div>
        </div>
    </div>

    <!-- Dados de Estrangeiro -->
    @if($funcionario->data_chegada_brasil || $funcionario->data_naturalizacao || $funcionario->casado_brasileiro || $funcionario->filho_brasileiro)
    <div class="section">
        <div class="section-title">DADOS DE ESTRANGEIRO</div>
        <div class="info-grid">
            @if($funcionario->data_chegada_brasil)
            <div class="info-row">
                <div class="info-label">Data de Chegada ao Brasil:</div>
                <div class="info-value">{{ $funcionario->data_chegada_brasil->format('d/m/Y') }}</div>
            </div>
            @endif
            @if($funcionario->data_naturalizacao)
            <div class="info-row">
                <div class="info-label">Data de Naturalização:</div>
                <div class="info-value">{{ $funcionario->data_naturalizacao->format('d/m/Y') }}</div>
            </div>
            @endif
            @if($funcionario->casado_brasileiro)
            <div class="info-row">
                <div class="info-label">Casado com Brasileiro:</div>
                <div class="info-value">{{ ucfirst($funcionario->casado_brasileiro) }}</div>
            </div>
            @endif
            @if($funcionario->filho_brasileiro)
            <div class="info-row">
                <div class="info-label">Filho com Brasileiro:</div>
                <div class="info-value">{{ ucfirst($funcionario->filho_brasileiro) }}</div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Dependentes -->
    <div class="section">
        <div class="section-title">DEPENDENTES ({{ $funcionario->dependentes->count() }})</div>
        @if($funcionario->dependentes->count() > 0)
            @foreach($funcionario->dependentes as $index => $dependente)
            <div class="dependente-card">
                <div class="dependente-title">Dependente {{ $index + 1 }}</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Nome:</div>
                        <div class="info-value">{{ $dependente->nome_completo }}</div>
                    </div>
                    @if($dependente->cpf)
                    <div class="info-row">
                        <div class="info-label">CPF:</div>
                        <div class="info-value">{{ $dependente->cpf_formatado }}</div>
                    </div>
                    @endif
                    <div class="info-row">
                        <div class="info-label">Data de Nascimento:</div>
                        <div class="info-value">{{ $dependente->data_nascimento->format('d/m/Y') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tipo de Dependência:</div>
                        <div class="info-value">
                            {{ ucfirst(str_replace('_', ' ', $dependente->tipo_dependencia)) }}
                            @if($dependente->tipo_dependencia == 'outros' && $dependente->outros_dependencia)
                                ({{ $dependente->outros_dependencia }})
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p style="text-align: center; color: #666; font-style: italic;">Nenhum dependente cadastrado</p>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Sistema E-Social - Cadastro de Funcionários | Documento gerado automaticamente em {{ date('d/m/Y H:i:s') }}</p>
        <p>ID do Funcionário: #{{ $funcionario->id }} | CPF: {{ $funcionario->cpf_formatado }}</p>
    </div>
</body>
</html>