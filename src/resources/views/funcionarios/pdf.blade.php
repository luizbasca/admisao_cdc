<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário - {{ $funcionario->nome }}</title>
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
    </div>

    <!-- Dados Pessoais -->
    <div class="section">
        <div class="section-title">DADOS PESSOAIS</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nome Completo:</div>
                <div class="info-value">{{ $funcionario->nome }}</div>
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
                <div class="info-value">{{ $funcionario->getGeneroFormatado() }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Estado Civil:</div>
                <div class="info-value">{{ $funcionario->getEstadoCivilFormatado() }}</div>
            </div>
            @if($funcionario->raca_cor)
            <div class="info-row">
                <div class="info-label">Raça/Cor:</div>
                <div class="info-value">{{ $funcionario->getRacaCorFormatada() }}</div>
            </div>
            @endif
            @if($funcionario->escolaridade)
            <div class="info-row">
                <div class="info-label">Escolaridade:</div>
                <div class="info-value">{{ $funcionario->getEscolaridadeFormatada() }}</div>
            </div>
            @endif
            @if($funcionario->deficiencia)
            <div class="info-row">
                <div class="info-label">Deficiência:</div>
                <div class="info-value">{{ $funcionario->getDeficienciaFormatada() }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Documento de Identificação -->
    <div class="section">
        <div class="section-title">DOCUMENTO DE IDENTIFICAÇÃO</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Tipo de Documento:</div>
                <div class="info-value">{{ $funcionario->getTipoDocumentoFormatado() }}</div>
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
    @if($funcionario->eh_estrangeiro || $funcionario->pais_origem || $funcionario->data_chegada_brasil)
    <div class="section">
        <div class="section-title">DADOS DE ESTRANGEIRO</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">É Estrangeiro:</div>
                <div class="info-value">{{ $funcionario->eh_estrangeiro ? 'Sim' : 'Não' }}</div>
            </div>
            @if($funcionario->pais_origem)
            <div class="info-row">
                <div class="info-label">País de Origem:</div>
                <div class="info-value">{{ $funcionario->pais_origem }}</div>
            </div>
            @endif
            @if($funcionario->tipo_visto)
            <div class="info-row">
                <div class="info-label">Tipo de Visto:</div>
                <div class="info-value">{{ $funcionario->tipo_visto }}</div>
            </div>
            @endif
            @if($funcionario->data_chegada_brasil)
            <div class="info-row">
                <div class="info-label">Data de Chegada ao Brasil:</div>
                <div class="info-value">{{ $funcionario->data_chegada_brasil->format('d/m/Y') }}</div>
            </div>
            @endif
            @if($funcionario->eh_estrangeiro)
            <div class="info-row">
                <div class="info-label">Casado com Brasileiro:</div>
                <div class="info-value">{{ $funcionario->casado_brasileiro ? 'Sim' : 'Não' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Possui Filhos Brasileiros:</div>
                <div class="info-value">{{ $funcionario->filhos_brasileiros ? 'Sim' : 'Não' }}</div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Informações Sindicais -->
    <div class="section">
        <div class="section-title">INFORMAÇÕES SINDICAIS</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Filiado a Sindicato:</div>
                <div class="info-value">{{ $funcionario->filiado_sindicato ? 'Sim' : 'Não' }}</div>
            </div>
            @if($funcionario->filiado_sindicato && $funcionario->nome_sindicato)
            <div class="info-row">
                <div class="info-label">Nome do Sindicato:</div>
                <div class="info-value">{{ $funcionario->nome_sindicato }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Trabalho em Outra Empresa -->
    <div class="section">
        <div class="section-title">TRABALHO EM OUTRA EMPRESA</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Trabalha em Outra Empresa:</div>
                <div class="info-value">{{ $funcionario->trabalhando_outra_empresa ? 'Sim' : 'Não' }}</div>
            </div>
            @if($funcionario->trabalhando_outra_empresa)
                @if($funcionario->nome_outra_empresa)
                <div class="info-row">
                    <div class="info-label">Nome da Outra Empresa:</div>
                    <div class="info-value">{{ $funcionario->nome_outra_empresa }}</div>
                </div>
                @endif
                @if($funcionario->salario_outra_empresa)
                <div class="info-row">
                    <div class="info-label">Salário na Outra Empresa:</div>
                    <div class="info-value">{{ $funcionario->getSalarioOutraEmpresaFormatado() }}</div>
                </div>
                @endif
            @endif
        </div>
    </div>

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
                        <div class="info-value">{{ $dependente->data_nascimento->format('d/m/Y') }} ({{ $dependente->getIdade() }} anos)</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tipo de Dependência:</div>
                        <div class="info-value">{{ $dependente->getTipoDependenciaFormatada() }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Dependente para IR:</div>
                        <div class="info-value">{{ $dependente->getDependenteIrFormatado() }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Dependente para Salário Família:</div>
                        <div class="info-value">{{ $dependente->getDependenteSalarioFamiliaFormatado() }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Dependente para Plano de Saúde:</div>
                        <div class="info-value">{{ $dependente->getDependentePlanoSaudeFormatado() }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p style="text-align: center; color: #666; font-style: italic;">Nenhum dependente cadastrado</p>
        @endif
    </div>

    <!-- Observações -->
    @if($funcionario->observacao)
    <div class="section">
        <div class="section-title">OBSERVAÇÕES</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Observação:</div>
                <div class="info-value">{{ $funcionario->observacao }}</div>
            </div>
        </div>
    </div>
    @endif

    <!-- LGPD -->
    <div class="section">
        <div class="section-title">TERMO DE CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS - LGPD</div>
        
        <!-- Texto completo do termo LGPD -->
        <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; background-color: #f9f9f9;">
            <p style="font-weight: bold; margin-bottom: 10px;">TERMO DE CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS</p>
            
            <p style="margin-bottom: 10px;">
                Pelo presente instrumento, o(a) Titular de dados pessoais, bem como seus dependentes, declara ciência de que os dados coletados serão utilizados para:
            </p>
            
            <p style="font-weight: bold; margin-bottom: 5px;">Finalidades legais:</p>
            <p style="margin-bottom: 8px;">elaboração do contrato de trabalho e cumprimento de obrigações legais e regulatórias perante os seguintes órgãos e sistemas:</p>
            <ul style="margin-bottom: 10px; padding-left: 20px;">
                <li>Receita Federal do Brasil;</li>
                <li>Instituto Nacional do Seguro Social (INSS);</li>
                <li>Caixa Econômica Federal (inclusive por meio da SEFIP e Conectividade Social);</li>
                <li>Portal do eSocial;</li>
                <li>Empregador Web;</li>
                <li>Plataforma Gov.br;</li>
                <li>Programa de Integração Social – PIS, quando aplicável;</li>
                <li>Declarações obrigatórias como RAIS e DIRF;</li>
                <li>Empresas de transporte para atividades remuneradas;</li>
                <li>Instituições bancárias para fins de processamento de folha e pagamento;</li>
                <li>Contato com a empresa.</li>
            </ul>
            
            <p style="margin-bottom: 10px;">
                <strong>Compartilhamento de dados:</strong> mediante o presente, o(a) Titular consente expressamente com o eventual compartilhamento de seus dados pessoais com prestadores de serviços contratados pela empresa, única e exclusivamente para o cumprimento das finalidades legais citadas.
            </p>
            
            <p style="margin-bottom: 10px;">
                <strong>Medidas de proteção e princípios da LGPD:</strong> Em conformidade com a Lei nº 13.709/2018 (LGPD), serão adotadas medidas técnicas e administrativas apropriadas para proteção dos dados pessoais contra acessos não autorizados e de situações acidentais ou ilícitas de destruição, perda, alteração, comunicação ou qualquer forma de tratamento inadequado ou ilícito, observando-se, entre outros.
            </p>
            
            <p style="margin-bottom: 10px;">
                <strong>Prazo de conservação:</strong> os dados pessoais serão armazenados enquanto perdurar o vínculo contratual e, após o encerramento, por até 2 (dois) anos, findo os quais serão eliminados ou anonimizados, conforme previsto na LGPD.
            </p>
            
            <p style="font-weight: bold; margin-bottom: 5px;">Declaração de consentimento do titular:</p>
            <p style="margin-bottom: 0;">
                Declaro que li e compreendi o conteúdo deste Termo de Consentimento para Tratamento de Dados Pessoais. Estou ciente de que os dados fornecidos serão utilizados para fins legais, conforme descrito, e autorizo seu tratamento e eventual compartilhamento nas condições aqui estabelecidas.
            </p>
        </div>
        
        <!-- Status da concordância -->
        <div class="info-grid" style="margin-bottom: 30px;">
            <div class="info-row">
                <div class="info-label">Status da Concordância:</div>
                <div class="info-value">
                    <span class="badge" style="{{ $funcionario->concordancia_lgpd ? 'background-color: #28a745;' : 'background-color: #dc3545;' }}">
                        {{ $funcionario->concordancia_lgpd ? 'CONCORDOU' : 'NÃO CONCORDOU' }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Campo para assinatura -->
        <div style="margin-top: 40px; page-break-inside: avoid;">
            <p style="font-weight: bold; margin-bottom: 20px;">ASSINATURA DO FUNCIONÁRIO:</p>
            
            <div style="display: table; width: 100%;">
                <div style="display: table-row;">
                    <div style="display: table-cell; width: 50%; padding-right: 20px;">
                        <div style="border-bottom: 1px solid #333; height: 60px; margin-bottom: 10px;"></div>
                        <p style="text-align: center; font-size: 11px; margin: 0;">
                            _________________________<br>
                            <strong>{{ $funcionario->nome }}</strong><br>
                            CPF: {{ $funcionario->cpf_formatado }}<br>
                            <strong>Data: ___/___/______</strong><br>
                            Local: _________________________
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Sistema E-Social - Cadastro de Funcionários | Documento gerado automaticamente em {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>