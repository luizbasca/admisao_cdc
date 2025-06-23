@extends('layouts.app')

@section('title', 'Novo Funcionário - Sistema E-Social')

@section('content')
<div class="main-container">
    <!-- Header -->
    <header class="mb-4">
        <h1 class="display-5 fw-bold mb-2">
            <i class="bi bi-person-plus-fill me-2"></i>
            Formulário de Cadastro de Funcionário
        </h1>
        <p class="lead mb-0">Sistema E-Social</p>
    </header>

    <!-- Main Form -->
    <form id="cadastroFuncionario" method="POST" action="{{ route('funcionarios.store') }}" novalidate>
        @csrf

        <!-- Dados do Funcionário -->
        <section class="card section-card" data-section="1">
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
                                   required maxlength="100" value="{{ old('nome_completo') }}">
                            <label for="nomeCompleto" class="required-field">Nome completo</label>
                            @error('nome_completo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">Digite o nome completo sem abreviações</div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" 
                                   id="cpf" name="cpf" placeholder="000.000.000-00" required 
                                   data-mask="cpf" value="{{ old('cpf') }}">
                            <label for="cpf" class="required-field">CPF</label>
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" 
                                   id="dataNascimento" name="data_nascimento" required value="{{ old('data_nascimento') }}">
                            <label for="dataNascimento" class="required-field">Data de nascimento</label>
                            @error('data_nascimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="paisNascimento" 
                                   name="pais_nascimento" placeholder="País" value="{{ old('pais_nascimento', 'Brasil') }}">
                            <label for="paisNascimento">País de nascimento</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('genero') is-invalid @enderror" 
                                    id="genero" name="genero" required>
                                <option value="">Selecione...</option>
                                <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="feminino" {{ old('genero') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                            </select>
                            <label for="genero" class="required-field">Gênero</label>
                            @error('genero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('estado_civil') is-invalid @enderror" 
                                    id="estadoCivil" name="estado_civil" required>
                                <option value="">Selecione...</option>
                                <option value="solteiro" {{ old('estado_civil') == 'solteiro' ? 'selected' : '' }}>Solteiro</option>
                                <option value="casado" {{ old('estado_civil') == 'casado' ? 'selected' : '' }}>Casado</option>
                                <option value="divorciado" {{ old('estado_civil') == 'divorciado' ? 'selected' : '' }}>Divorciado</option>
                                <option value="viuvo" {{ old('estado_civil') == 'viuvo' ? 'selected' : '' }}>Viúvo</option>
                                <option value="uniao_estavel" {{ old('estado_civil') == 'uniao_estavel' ? 'selected' : '' }}>União Estável</option>
                                <option value="outros" {{ old('estado_civil') == 'outros' ? 'selected' : '' }}>Outros</option>
                            </select>
                            <label for="estadoCivil" class="required-field">Estado Civil</label>
                            @error('estado_civil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2" id="outrosEstadoContainer" style="display: {{ old('estado_civil') == 'outros' ? 'block' : 'none' }};">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('outros_estado_texto') is-invalid @enderror" 
                                       id="outrosEstadoTexto" name="outros_estado_texto" placeholder="Especificar"
                                       value="{{ old('outros_estado_texto') }}">
                                <label for="outrosEstadoTexto">Especificar outros</label>
                                @error('outros_estado_texto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="racaCor" name="raca_cor">
                                <option value="">Selecione...</option>
                                <option value="branco" {{ old('raca_cor') == 'branco' ? 'selected' : '' }}>Branco</option>
                                <option value="negro" {{ old('raca_cor') == 'negro' ? 'selected' : '' }}>Negro</option>
                                <option value="pardo" {{ old('raca_cor') == 'pardo' ? 'selected' : '' }}>Pardo</option>
                                <option value="amarelo" {{ old('raca_cor') == 'amarelo' ? 'selected' : '' }}>Amarelo</option>
                                <option value="indigena" {{ old('raca_cor') == 'indigena' ? 'selected' : '' }}>Indígena</option>
                                <option value="nao_informado" {{ old('raca_cor') == 'nao_informado' ? 'selected' : '' }}>Não Informado</option>
                            </select>
                            <label for="racaCor">Raça e Cor</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="escolaridade" name="escolaridade">
                                <option value="">Selecione...</option>
                                <option value="01" {{ old('escolaridade') == '01' ? 'selected' : '' }}>Analfabeto</option>
                                <option value="02" {{ old('escolaridade') == '02' ? 'selected' : '' }}>Até 4ª série incompleta (EF)</option>
                                <option value="03" {{ old('escolaridade') == '03' ? 'selected' : '' }}>4ª série completa (EF)</option>
                                <option value="04" {{ old('escolaridade') == '04' ? 'selected' : '' }}>De 5ª a 8ª série (EF)</option>
                                <option value="05" {{ old('escolaridade') == '05' ? 'selected' : '' }}>Ensino Fundamental Completo</option>
                                <option value="06" {{ old('escolaridade') == '06' ? 'selected' : '' }}>Ensino Médio Incompleto</option>
                                <option value="07" {{ old('escolaridade') == '07' ? 'selected' : '' }}>Ensino Médio Completo</option>
                                <option value="08" {{ old('escolaridade') == '08' ? 'selected' : '' }}>Ensino Superior Incompleto</option>
                                <option value="09" {{ old('escolaridade') == '09' ? 'selected' : '' }}>Ensino Superior Completo</option>
                                <option value="10" {{ old('escolaridade') == '10' ? 'selected' : '' }}>Pós Graduação</option>
                                <option value="12" {{ old('escolaridade') == '12' ? 'selected' : '' }}>Doutorado</option>
                                <option value="13" {{ old('escolaridade') == '13' ? 'selected' : '' }}>Outros</option>
                            </select>
                            <label for="escolaridade">Escolaridade</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="deficiencia" name="deficiencia">
                                <option value="">Selecione...</option>
                                <option value="01" {{ old('deficiencia') == '01' ? 'selected' : '' }}>Não tenho Deficiência</option>
                                <option value="02" {{ old('deficiencia') == '02' ? 'selected' : '' }}>Auditiva</option>
                                <option value="03" {{ old('deficiencia') == '03' ? 'selected' : '' }}>Visual</option>
                                <option value="04" {{ old('deficiencia') == '04' ? 'selected' : '' }}>Intelectual</option>
                                <option value="05" {{ old('deficiencia') == '05' ? 'selected' : '' }}>Mental</option>
                                <option value="06" {{ old('deficiencia') == '06' ? 'selected' : '' }}>Reabilitado</option>
                            </select>
                            <label for="deficiencia">Deficiência</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="obsDeficiencia" name="obs_deficiencia" 
                                      style="height: 100px" placeholder="Observações">{{ old('obs_deficiencia') }}</textarea>
                            <label for="obsDeficiencia">Observações sobre deficiência</label>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Documento de Identificação -->
        <section class="card section-card" data-section="2">
            <div class="section-header">
                <i class="bi bi-card-text"></i>
                <h2 class="h4 mb-0">Documento de Identificação</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    Selecione apenas <strong>UM DOCUMENTO DE IDENTIFICAÇÃO</strong> e preencha os campos necessários.
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label required-field">Tipo de Documento</label>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input @error('tipo_documento') is-invalid @enderror" 
                                           type="radio" name="tipo_documento" id="rg" value="rg" required
                                           {{ old('tipo_documento') == 'rg' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rg">RG - Registro Geral</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_documento" 
                                           id="cnh" value="cnh" required {{ old('tipo_documento') == 'cnh' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cnh">CNH - Carteira Nacional de Habilitação</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_documento" 
                                           id="ric" value="ric" required {{ old('tipo_documento') == 'ric' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ric">RIC - Registro de Identidade Civil</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_documento" 
                                           id="rne" value="rne" required {{ old('tipo_documento') == 'rne' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rne">RNE - Registro Nacional de Estrangeiro</label>
                                </div>
                            </div>
                        </div>
                        @error('tipo_documento')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('numero_documento') is-invalid @enderror" 
                                   id="numeroDocumento" name="numero_documento" placeholder="Número" required
                                   value="{{ old('numero_documento') }}">
                            <label for="numeroDocumento" class="required-field">Número do Documento</label>
                            @error('numero_documento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('orgao_emissor') is-invalid @enderror" 
                                   id="orgaoEmissor" name="orgao_emissor" placeholder="Órgão" required
                                   value="{{ old('orgao_emissor') }}">
                            <label for="orgaoEmissor" class="required-field">Órgão Emissor</label>
                            @error('orgao_emissor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('data_emissao') is-invalid @enderror" 
                                   id="dataEmissao" name="data_emissao" value="{{ old('data_emissao') }}">
                            <label for="dataEmissao">Data de Emissão</label>
                            @error('data_emissao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('data_validade') is-invalid @enderror" 
                                   id="dataValidade" name="data_validade" value="{{ old('data_validade') }}">
                            <label for="dataValidade">Data de Validade</label>
                            @error('data_validade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="infoAdicionais" name="info_adicionais" 
                                      style="height: 100px" placeholder="Informações">{{ old('info_adicionais') }}</textarea>
                            <label for="infoAdicionais">Informações Adicionais</label>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Endereço -->
        <section class="card section-card" data-section="3">
            <div class="section-header">
                <i class="bi bi-geo-alt-fill"></i>
                <h2 class="h4 mb-0">Endereço</h2>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('rua') is-invalid @enderror" 
                                id="rua" name="rua" placeholder="Nome da rua" required maxlength="100">
                            <label for="rua" class="required-field">Logradouro</label>
                            @error('rua')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('numero') is-invalid @enderror" 
                                id="numero" name="numero" placeholder="123" required maxlength="10">
                            <label for="numero" class="required-field">Número</label>
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="complemento" name="complemento" 
                                   placeholder="Complemento" value="{{ old('complemento') }}">
                            <label for="complemento">Complemento</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('bairro') is-invalid @enderror" 
                                   id="bairro" name="bairro" placeholder="Bairro" required value="{{ old('bairro') }}">
                            <label for="bairro" class="required-field">Bairro</label>
                            @error('bairro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('cidade') is-invalid @enderror" 
                                   id="cidade" name="cidade" placeholder="Cidade" required value="{{ old('cidade') }}">
                            <label for="cidade" class="required-field">Cidade</label>
                            @error('cidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value="">Selecione...</option>
                                @php
                                    $estados = [
                                        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
                                        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
                                        'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
                                        'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
                                        'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
                                        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
                                        'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
                                    ];
                                @endphp
                                @foreach($estados as $sigla => $nome)
                                    <option value="{{ $sigla }}" {{ old('estado') == $sigla ? 'selected' : '' }}>{{ $nome }}</option>
                                @endforeach
                            </select>
                            <label for="estado" class="required-field">Estado</label>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('cep') is-invalid @enderror" 
                                id="cep" name="cep" placeholder="00000-000" required>
                            <label for="cep" class="required-field">CEP</label>
                            @error('cep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Funcionário Estrangeiro -->
        <section class="card section-card" data-section="4">
            <div class="section-header">
                <i class="bi bi-globe"></i>
                <h2 class="h4 mb-0">Para Funcionário Estrangeiro</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Preencha apenas se for estrangeiro</strong>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="dataChegadaBrasil" 
                                   name="data_chegada_brasil" value="{{ old('data_chegada_brasil') }}">
                            <label for="dataChegadaBrasil">Data da chegada ao Brasil</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="dataNaturalizacao" 
                                   name="data_naturalizacao" value="{{ old('data_naturalizacao') }}">
                            <label for="dataNaturalizacao">Data de naturalização brasileira</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Casado com brasileiro</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="casado_brasileiro" 
                                       id="casadoBrasileiroSim" value="sim" {{ old('casado_brasileiro') == 'sim' ? 'checked' : '' }}>
                                <label class="form-check-label" for="casadoBrasileiroSim">Sim</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="casado_brasileiro" 
                                       id="casadoBrasileiroNao" value="nao" {{ old('casado_brasileiro') == 'nao' ? 'checked' : '' }}>
                                <label class="form-check-label" for="casadoBrasileiroNao">Não</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Filho com brasileiro</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="filho_brasileiro" 
                                       id="filhoBrasileiroSim" value="sim" {{ old('filho_brasileiro') == 'sim' ? 'checked' : '' }}>
                                <label class="form-check-label" for="filhoBrasileiroSim">Sim</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="filho_brasileiro" 
                                       id="filhoBrasileiroNao" value="nao" {{ old('filho_brasileiro') == 'nao' ? 'checked' : '' }}>
                                <label class="form-check-label" for="filhoBrasileiroNao">Não</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dependentes -->
        <section class="card section-card" data-section="5">
            <div class="section-header">
                <i class="bi bi-people-fill"></i>
                <h2 class="h4 mb-0">Dependentes</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Atenção:</strong> Caso o funcionário tenha dependentes para o Imposto de Renda, 
                    é obrigatório preencher a Declaração de Dependentes para o Imposto de Renda.
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Lista de Dependentes</h5>
                    <button type="button" class="btn btn-primary btn-sm" id="adicionarDependente">
                        <i class="bi bi-person-plus me-2"></i>Adicionar Dependente
                    </button>
                </div>

                <div id="dependentesContainer">
                    <!-- Dependentes serão adicionados aqui dinamicamente -->
                </div>

                <div id="semDependentes" class="text-center text-muted py-4">
                    <i class="bi bi-person-x fs-1"></i>
                    <p class="mt-2">Nenhum dependente adicionado</p>
                    <small>Clique em "Adicionar Dependente" para incluir um dependente</small>
                </div>
            </div>
        </section>

        <!-- Submit Button -->
        <div class="text-center py-4">
            <button type="submit" class="btn btn-success btn-submit">
                <i class="bi bi-check-circle me-2"></i>
                Enviar Formulário e Gerar PDF
            </button>
        </div>
    </form>
</div>
@endsection