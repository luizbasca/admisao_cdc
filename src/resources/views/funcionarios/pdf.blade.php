<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Ficha Cadastral - {{ $funcionario->nome }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

    body {
      background: #fff;
      font-family: 'Roboto', serif;
      font-size: 13px;
      color: #222;
      margin: 0;
      padding: 0;
    }

    .doc-container {
      max-width: 900px;
      margin: 32px auto 0 auto;
      padding: 0 32px 32px 32px;
      background: #fff;
      border: 1px solid #bbb;
      border-radius: 6px;
    }

    .header {
      text-align: center;
      border-bottom: 2px solid #222;
      padding: 32px 0 18px 0;
      margin-bottom: 24px;
    }

    .header-title {
      font-size: 1.7rem;
      font-weight: 700;
      color: #222;
      margin-bottom: 0.2rem;
      letter-spacing: 0.01em;
    }

    .header-meta {
      font-size: 1rem;
      color: #444;
      margin-bottom: 0.5rem;
    }

    .section-title {
      font-size: 1.08rem;
      color: #222;
      font-weight: 600;
      margin-bottom: 0.5rem;
      margin-top: 1.2rem;
      letter-spacing: 0.01em;
      border-bottom: 1px solid #bbb;
      padding-bottom: 4px;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 12px;
    }

    .data-table td {
      padding: 6px 8px;
      border: 1px solid #e0e0e0;
      vertical-align: top;
    }

    .data-label {
      font-weight: 500;
      color: #444;
      width: 180px;
      background: #f5f5f5;
    }

    .data-value {
      color: #222;
    }

    .dependente-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 8px;
    }

    .dependente-table th,
    .dependente-table td {
      border: 1px solid #e0e0e0;
      padding: 6px 8px;
      font-size: 13px;
    }

    .dependente-table th {
      background: #f5f5f5;
      font-weight: 500;
      text-align: left;
    }

    .signature-area {
      margin: 40px 0 0 0;
      text-align: center;
    }

    .signature-line {
      border-bottom: 1px solid #333;
      width: 320px;
      margin: 0 auto 8px auto;
      height: 32px;
    }

    .signature-name {
      font-weight: 600;
      font-size: 15px;
      color: #222;
      margin-bottom: 2px;
    }

    .signature-cpf {
      color: #444;
      font-size: 13px;
    }

    .footer {
      font-size: 0.95rem;
      color: #888;
      border-top: 1px solid #e0e0e0;
      margin-top: 2rem;
      padding-top: 0.7rem;
      text-align: center;
    }

    .lgpd-section {
      background: #f8f8f8;
      border: 1px solid #e0e0e0;
      border-radius: 4px;
      padding: 16px 18px;
      margin-bottom: 12px;
      font-size: 13px;
      color: #444;
      text-align: justify;
    }

    .badge {
      display: inline-block;
      padding: 3px 14px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 500;
      margin-left: 8px;
    }

    .badge-success {
      background: #e6f4ea;
      color: #256029;
      border: 1px solid #b6e2c6;
    }

    .badge-danger {
      background: #fbeaea;
      color: #a12727;
      border: 1px solid #f5bcbc;
    }

    @media (max-width: 600px) {
      .doc-container {
        padding: 0 2px;
      }

      .header {
        padding: 18px 0 10px 0;
      }
    }

    @media print {
      body {
        background: #fff;
      }

      .doc-container {
        box-shadow: none;
        border-radius: 0;
      }

      .footer {
        color: #444;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <div class="header-title">Ficha Cadastral de Funcionário</div>
      <div class="header-meta">Emitido pelo Sistema E-Social em: {{ date('d/m/Y H:i:s') }}</div>
    </div>

    <div class="section-title">Dados Pessoais</div>
    <table class="data-table">
      <tr>
        <td class="data-label">Nome Completo</td>
        <td class="data-value">{{ $funcionario->nome }}</td>
      </tr>
      <tr>
        <td class="data-label">CPF</td>
        <td class="data-value">{{ $funcionario->cpf_formatado }}</td>
      </tr>
      <tr>
        <td class="data-label">Data de Nascimento</td>
        <td class="data-value">{{ $funcionario->data_nascimento->format('d/m/Y') }}</td>
      </tr>
      <tr>
        <td class="data-label">Gênero</td>
        <td class="data-value">{{ $funcionario->getGeneroFormatado() }}</td>
      </tr>
      <tr>
        <td class="data-label">Estado Civil</td>
        <td class="data-value">{{ $funcionario->getEstadoCivilFormatado() }}</td>
      </tr>
      <tr>
        <td class="data-label">Raça/Cor</td>
        <td class="data-value">{{ $funcionario->getRacaCorFormatada() }}</td>
      </tr>
      <tr>
        <td class="data-label">Escolaridade</td>
        <td class="data-value">{{ $funcionario->getEscolaridadeFormatada() }}</td>
      </tr>
      <tr>
        <td class="data-label">País de Nascimento</td>
        <td class="data-value">{{ $funcionario->pais_nascimento ?? 'Brasil' }}</td>
      </tr>
      <tr>
        <td class="data-label">Deficiência</td>
        <td class="data-value">{{ $funcionario->getDeficienciaFormatada() }}</td>
      </tr>
    </table>

    <div class="section-title">Documentação</div>
    <table class="data-table">
      <tr>
        <td class="data-label">Tipo de Documento</td>
        <td class="data-value">{{ $funcionario->getTipoDocumentoFormatado() }}</td>
      </tr>
      <tr>
        <td class="data-label">Número</td>
        <td class="data-value">{{ $funcionario->numero_documento }}</td>
      </tr>
      <tr>
        <td class="data-label">Órgão Emissor</td>
        <td class="data-value">{{ $funcionario->orgao_emissor }}</td>
      </tr>
      @if($funcionario->data_emissao)
      <tr>
        <td class="data-label">Data de Emissão</td>
        <td class="data-value">{{ $funcionario->data_emissao->format('d/m/Y') }}</td>
      </tr>
      @endif
      @if($funcionario->data_validade)
      <tr>
        <td class="data-label">Data de Validade</td>
        <td class="data-value">{{ $funcionario->data_validade->format('d/m/Y') }}</td>
      </tr>
      @endif
    </table>

    <div class="section-title">Endereço</div>
    <table class="data-table">
      <tr>
        <td class="data-label">Endereço Completo</td>
        <td class="data-value">{{ $funcionario->rua }}, {{ $funcionario->numero }}{{ $funcionario->complemento ? ', ' . $funcionario->complemento : '' }} - {{ $funcionario->bairro }} - {{ $funcionario->cidade }}/{{ $funcionario->estado }} - CEP: {{ $funcionario->cep_formatado }}</td>
      </tr>
    </table>

    <div class="section-title">Informações Adicionais</div>
    <table class="data-table">
      <tr>
        <td class="data-label">Filiado a Sindicato</td>
        <td class="data-value">{{ $funcionario->filiado_sindicato ? 'Sim' : 'Não' }}</td>
      </tr>
      @if($funcionario->filiado_sindicato && $funcionario->nome_sindicato)
      <tr>
        <td class="data-label">Nome do Sindicato</td>
        <td class="data-value">{{ $funcionario->nome_sindicato }}</td>
      </tr>
      @endif
      <tr>
        <td class="data-label">Trabalha em Outra Empresa</td>
        <td class="data-value">{{ $funcionario->trabalhando_outra_empresa ? 'Sim' : 'Não' }}</td>
      </tr>
      @if($funcionario->trabalhando_outra_empresa)
      <tr>
        <td class="data-label">Nome da Empresa</td>
        <td class="data-value">{{ $funcionario->nome_outra_empresa ?? 'N/A' }}</td>
      </tr>
      <tr>
        <td class="data-label">Salário</td>
        <td class="data-value">R$ {{ number_format($funcionario->salario_outra_empresa ?? 0, 2, ',', '.') }}</td>
      </tr>
      @endif
    </table>

    <div class="section-title">Dependentes</div>
    @if($funcionario->possui_dependentes && $funcionario->dependentes->count() > 0)
    <table class="dependente-table">
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Nascimento</th>
        <th>Tipo</th>
        <th>CPF</th>
        <th>IR</th>
        <th>Salário Família</th>
        <th>Plano Saúde</th>
      </tr>
      @foreach($funcionario->dependentes as $index => $dependente)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $dependente->nome_completo }}</td>
        <td>{{ $dependente->data_nascimento->format('d/m/Y') }} ({{ $dependente->getIdade() }} anos)</td>
        <td>{{ $dependente->getTipoDependenciaFormatada() }}</td>
        <td>{{ $dependente->cpf_formatado ?? '-' }}</td>
        <td>{{ $dependente->dependente_ir ? 'Sim' : 'Não' }}</td>
        <td>{{ $dependente->dependente_salario_familia ? 'Sim' : 'Não' }}</td>
        <td>{{ $dependente->dependente_plano_saude ? 'Sim' : 'Não' }}</td>
      </tr>
      @endforeach
    </table>
    @else
    <table class="data-table">
      <tr>
        <td class="data-label">Status</td>
        <td class="data-value">Não possui dependentes</td>
      </tr>
    </table>
    @endif

    @if($funcionario->eh_estrangeiro)
    <div class="section-title">Informações de Estrangeiro</div>
    <table class="data-table">
      <tr>
        <td class="data-label">País de Origem</td>
        <td class="data-value">{{ $funcionario->pais_origem }}</td>
      </tr>
      @if($funcionario->data_chegada_brasil)
      <tr>
        <td class="data-label">Chegada ao Brasil</td>
        <td class="data-value">{{ $funcionario->data_chegada_brasil->format('d/m/Y') }}</td>
      </tr>
      @endif
      <tr>
        <td class="data-label">Tipo de Visto</td>
        <td class="data-value">{{ $funcionario->tipo_visto }}</td>
      </tr>
      <tr>
        <td class="data-label">Casado(a) com Brasileiro(a)</td>
        <td class="data-value">{{ $funcionario->casado_brasileiro ? 'Sim' : 'Não' }}</td>
      </tr>
      <tr>
        <td class="data-label">Filhos Brasileiros</td>
        <td class="data-value">{{ $funcionario->filhos_brasileiros ? 'Sim' : 'Não' }}</td>
      </tr>
    </table>
    @endif

    @if($funcionario->observacao)
    <div class="section-title">Observações</div>
    <table class="data-table">
      <tr>
        <td class="data-label">Observações</td>
        <td class="data-value">{{ $funcionario->observacao }}</td>
      </tr>
    </table>
    @endif

    <div class="section-title">Termo de Consentimento (LGPD)</div>
    <div class="lgpd-section">
        <p>Pelo presente instrumento, o(a) Titular de dados pessoais declara ciência de que os dados coletados serão utilizados para:</p>

        <p><strong>Finalidades legais:</strong> elaboração do contrato de trabalho e cumprimento de obrigações legais perante órgãos como Receita Federal, INSS, Caixa Econômica Federal, eSocial, Gov.br, instituições bancárias e demais entidades competentes.</p>

        <p><strong>Compartilhamento:</strong> o Titular consente com o compartilhamento de dados com prestadores de serviços contratados, exclusivamente para cumprimento das finalidades legais.</p>

        <p><strong>Proteção:</strong> serão adotadas medidas técnicas e administrativas para proteção dos dados conforme LGPD (Lei nº 13.709/2018).</p>

        <p><strong>Prazo:</strong> os dados serão conservados durante o vínculo contratual e por até 2 anos após o encerramento.</p>

        <p><strong>Declaração:</strong> Declaro que li e autorizo o tratamento dos dados nas condições estabelecidas.</p>

        <p>Status:
			  @if($funcionario->concordancia_lgpd)
			  <span class="badge badge-success">CONCEDIDO</span>
			  @else
			  <span class="badge badge-danger">NEGADO</span>
			  @endif
        </p>
    </div>
    
    <div class="signature-area">
      <div class="signature-line"></div>
      <div class="signature-name">{{ $funcionario->nome }}</div>
      <div class="signature-cpf">CPF: {{ $funcionario->cpf_formatado }}</div>
    </div>

    <div class="footer">
      Este é um documento gerado pelo sistema. Todos os direitos reservados.
    </div>
  </div>
</body>

</html>