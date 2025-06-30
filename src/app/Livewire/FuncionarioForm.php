<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Funcionario;
use Illuminate\Validation\Rule;

class FuncionarioForm extends Component
{
    public $funcionario = [
        // Dados Pessoais
        'nome' => '',
        'cpf' => '',
        'data_nascimento' => '',
        'pais_nascimento' => '',
        'genero' => '',
        'estado_civil' => '',
        'outros_estado_texto' => '',
        'raca_cor' => '',
        'outros_raca_texto' => '',
        'escolaridade' => '',
        'deficiencia' => '',

        // Documento de Identificação
        'tipo_documento' => '',
        'numero_documento' => '',
        'orgao_emissor' => '',
        'data_emissao' => '',
        'data_validade' => '',

        // Endereço
        'cep' => '',
        'rua' => '',
        'numero' => '',
        'complemento' => '',
        'bairro' => '',
        'cidade' => '',
        'estado' => '',

        // Funcionário Estrangeiro
        'eh_estrangeiro' => false,
        'pais_origem' => '',
        'tipo_visto' => '',
        'data_chegada_brasil' => '',
        'casado_brasileiro' => false,
        'filhos_brasileiros' => false,

        // Observações
        'observacao' => '',
    ];

    public $dependentes = [];
    public $maxDependentes = 5;

    // Opções para selects
    public $estadosCivis = [
        'solteiro' => 'Solteiro',
        'casado' => 'Casado',
        'divorciado' => 'Divorciado',
        'viuvo' => 'Viúvo',
        'uniao_estavel' => 'União Estável',
    ];

    public $racasCores = [
        'branco' => 'Branco',
        'negro' => 'Negro',
        'pardo' => 'Pardo',
        'amarelo' => 'Amarelo',
        'indigena' => 'Indígena',
        'nao_informado' => 'Não informado',
    ];

    public $escolaridades = [
        '01' => 'Analfabeto',
        '02' => 'Até 4ª série incompl. (EF)',
        '03' => '4ª série completa (EF)',
        '04' => 'De 5ª a 8ª série (EF)',
        '05' => 'Ensino Fundam Completo',
        '06' => 'Ensino Médio Incompleto',
        '07' => 'Ensino Médio Completo',
        '08' => 'Ensino Superior Incompleto',
        '09' => 'Ensino Superior Completo',
        '10' => 'Pós Graduação',
        '12' => 'Doutorado',
        '13' => 'Outros'
    ];

    public $tiposDeficiencia = [
        '01' => 'Nenhuma',
        '02' => 'Física',
        '03' => 'Auditiva',
        '04' => 'Visual',
        '05' => 'Intelectual',
        '06' => 'Múltipla',
        '07' => 'Reabilitado'
    ];

    public $tiposDocumento = [
        'rg' => 'RG - Registro Geral',
        'cnh' => 'CNH - Carteira Nacional de Habilitação',
        'ctps' => 'CTPS - Carteira de Trabalho',
        'ric' => 'RIC - Registro de Identidade Civil',
    ];

    public $estadosBrasil = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins'
    ];

    public $tiposDependencia = [
        'filho_menor_21' => 'Filho(a) menor de 21 anos',
        'filho_universitario' => 'Filho(a) universitário até 24 anos',
        'filho_deficiente' => 'Filho(a) com deficiência',
        'conjuge' => 'Cônjuge',
        'companheiro' => 'Companheiro(a)',
        'pais' => 'Pais',
        'outros' => 'Outros'
    ];

    protected $rules = [
        // Dados Pessoais - Obrigatórios
        'funcionario.nome' => 'required|string|max:100',
        'funcionario.cpf' => 'required|cpf|unique:funcionarios,cpf',
        'funcionario.data_nascimento' => 'required|date|before:today',
        'funcionario.genero' => 'required|in:masculino,feminino',
        'funcionario.estado_civil' => 'required',
        'funcionario.pais_nascimento' => 'required|string',
        'funcionario.outros_estado_texto' => 'required_if:funcionario.estado_civil,outros|max:50',
        'funcionario.raca_cor' => 'required',
        'funcionario.outros_raca_texto' => 'required_if:funcionario.raca_cor,outros|max:50',
        'funcionario.escolaridade' => 'required',
        'funcionario.deficiencia' => 'required',

        // Documento de Identificação - Obrigatórios
        'funcionario.tipo_documento' => 'required',
        'funcionario.numero_documento' => 'required|string|max:50',
        'funcionario.orgao_emissor' => 'required|string|max:20',

        // Endereço - Obrigatórios
        'funcionario.cep' => 'required|string|size:9',
        'funcionario.rua' => 'required|string|max:100',
        'funcionario.numero' => 'required|string|max:10',
        'funcionario.bairro' => 'required|string|max:50',
        'funcionario.cidade' => 'required|string|max:50',
        'funcionario.estado' => 'required|string|size:2',

        // Funcionário Estrangeiro - Condicionais
        'funcionario.pais_origem' => 'required_if:funcionario.eh_estrangeiro,true|max:50',
        'funcionario.tipo_visto' => 'required_if:funcionario.eh_estrangeiro,true|max:50',
        'funcionario.data_chegada_brasil' => 'required_if:funcionario.eh_estrangeiro,true|date',

        // Dependentes
        'dependentes.*.nome_completo' => 'required|string|max:100',
        'dependentes.*.cpf' => 'required|cpf',
        'dependentes.*.data_nascimento' => 'required|date|before:today',
        'dependentes.*.tipo_dependencia' => 'required|string',
        'dependentes.*.outros_especificar' => 'required_if:dependentes.*.tipo_dependencia,outros|max:100',
    ];


    protected $messages = [
        // Dados Pessoais
        'funcionario.nome.required' => 'O nome é obrigatório.',
        'funcionario.nome.max' => 'O nome deve ter no máximo 100 caracteres.',
        'funcionario.cpf.required' => 'O CPF é obrigatório.',
        'funcionario.cpf.cpf' => 'O CPF deve ser válido.',
        'funcionario.cpf.unique' => 'Este CPF já está cadastrado.',
        'funcionario.data_nascimento.required' => 'A data de nascimento é obrigatória.',
        'funcionario.data_nascimento.date' => 'A data de nascimento deve ser uma data válida.',
        'funcionario.data_nascimento.before' => 'A data de nascimento deve ser anterior a hoje.',
        'funcionario.genero.required' => 'O gênero é obrigatório.',
        'funcionario.pais_nascimento.required' => 'O pais nascimento é obrigatório.',
        'funcionario.genero.in' => 'O gênero deve ser masculino ou feminino.',
        'funcionario.estado_civil.required' => 'O estado civil é obrigatório.',
        'funcionario.outros_estado_texto.required_if' => 'Especifique o estado civil quando selecionar "Outros".',
        'funcionario.outros_estado_texto.max' => 'A especificação do estado civil deve ter no máximo 50 caracteres.',
        'funcionario.raca_cor.required' => 'A raça/cor é obrigatória.',
        'funcionario.outros_raca_texto.required_if' => 'Especifique a raça/cor quando selecionar "Outros".',
        'funcionario.outros_raca_texto.max' => 'A especificação da raça/cor deve ter no máximo 50 caracteres.',
        'funcionario.escolaridade.required' => 'A escolaridade é obrigatória.',
        'funcionario.deficiencia.required' => 'A informação sobre deficiência é obrigatória.',

        // Documento de Identificação
        'funcionario.tipo_documento.required' => 'O tipo de documento é obrigatório.',
        'funcionario.numero_documento.required' => 'O número do documento é obrigatório.',
        'funcionario.numero_documento.max' => 'O número do documento deve ter no máximo 50 caracteres.',
        'funcionario.orgao_emissor.required' => 'O órgão emissor é obrigatório.',
        'funcionario.orgao_emissor.max' => 'O órgão emissor deve ter no máximo 20 caracteres.',

        // Endereço
        'funcionario.cep.required' => 'O CEP é obrigatório.',
        'funcionario.cep.size' => 'O CEP deve ter 9 caracteres (formato: 00000-000).',
        'funcionario.rua.required' => 'A logradouro é obrigatória.',
        'funcionario.rua.max' => 'A logradouro deve ter no máximo 100 caracteres.',
        'funcionario.numero.required' => 'O número é obrigatório.',
        'funcionario.numero.max' => 'O número deve ter no máximo 10 caracteres.',
        'funcionario.bairro.required' => 'O bairro é obrigatório.',
        'funcionario.bairro.max' => 'O bairro deve ter no máximo 50 caracteres.',
        'funcionario.cidade.required' => 'A cidade é obrigatória.',
        'funcionario.cidade.max' => 'A cidade deve ter no máximo 50 caracteres.',
        'funcionario.estado.required' => 'O estado é obrigatório.',
        'funcionario.estado.size' => 'O estado deve ter exatamente 2 caracteres.',

        // Funcionário Estrangeiro
        'funcionario.pais_origem.required_if' => 'O país de origem é obrigatório para funcionários estrangeiros.',
        'funcionario.pais_origem.max' => 'O país de origem deve ter no máximo 50 caracteres.',
        'funcionario.tipo_visto.required_if' => 'O tipo de visto é obrigatório para funcionários estrangeiros.',
        'funcionario.tipo_visto.max' => 'O tipo de visto deve ter no máximo 50 caracteres.',
        'funcionario.data_chegada_brasil.required_if' => 'A data de chegada ao Brasil é obrigatória para funcionários estrangeiros.',
        'funcionario.data_chegada_brasil.date' => 'A data de chegada ao Brasil deve ser uma data válida.',

        // Dependentes
        'dependentes.*.nome_completo.required' => 'O nome completo do dependente é obrigatório.',
        'dependentes.*.nome_completo.max' => 'O nome completo do dependente deve ter no máximo 100 caracteres.',
        'dependentes.*.cpf.cpf' => 'O CPF do dependente deve ser válido.',
        'dependentes.*.cpf.required' => 'O CPF do dependente é obrigatório.',
        'dependentes.*.data_nascimento.required' => 'A data de nascimento do dependente é obrigatória.',
        'dependentes.*.data_nascimento.date' => 'A data de nascimento do dependente deve ser uma data válida.',
        'dependentes.*.data_nascimento.before' => 'A data de nascimento do dependente deve ser anterior a hoje.',
        'dependentes.*.tipo_dependencia.required' => 'O tipo de dependência é obrigatório.',
        'dependentes.*.outros_especificar.required_if' => 'Especifique o tipo de dependência quando selecionar "Outros".',
        'dependentes.*.outros_especificar.max' => 'A especificação do tipo de dependência deve ter no máximo 100 caracteres.',
    ];

    public function mount($funcionarioId = null)
    {
        if ($funcionarioId) {
            $funcionario = Funcionario::with('dependentes')->findOrFail($funcionarioId);
            $this->funcionario = $funcionario->toArray();
            $this->dependentes = $funcionario->dependentes->toArray();
        }
    }

    public function adicionarDependente()
    {
        if (count($this->dependentes) >= $this->maxDependentes) {
            session()->flash('error', "Máximo de {$this->maxDependentes} dependentes permitidos.");
            return;
        }

        $this->dependentes[] = [
            'nome_completo' => '',
            'cpf' => '',
            'data_nascimento' => '',
            'tipo_dependencia' => '',
            'outros_especificar' => '',
            'dependente_ir' => false,
            'dependente_salario_familia' => false,
            'dependente_plano_saude' => false
        ];
    }

    public function removerDependente($index)
    {
        unset($this->dependentes[$index]);
        $this->dependentes = array_values($this->dependentes);

        session()->flash('success', 'Dependente removido com sucesso.');
    }


    public function updatedFuncionarioCep()
    {
        $cep = preg_replace('/\D/', '', $this->funcionario['cep']);

        if (strlen($cep) == 8) {
            $this->buscarCep();
        }
    }

    public function buscarCep()
    {
        $cep = preg_replace('/\D/', '', $this->funcionario['cep']);

        if (strlen($cep) != 8) {
            session()->flash('error', 'CEP deve ter 8 dígitos.');
            return;
        }

        try {
            // Usando cURL para melhor controle da requisição
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://viacep.com.br/ws/{$cep}/json/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                throw new \Exception('Erro na consulta do CEP');
            }

            $data = json_decode($response, true);

            if (!isset($data['erro'])) {
                // Preenche os campos automaticamente
                $this->funcionario['rua'] = $data['logradouro'] ?? '';
                $this->funcionario['bairro'] = $data['bairro'] ?? '';
                $this->funcionario['cidade'] = $data['localidade'] ?? '';
                $this->funcionario['estado'] = $data['uf'] ?? '';

                // Formata o CEP com hífen se não estiver formatado
                $this->funcionario['cep'] = substr($cep, 0, 5) . '-' . substr($cep, 5);

                session()->flash('success', 'Endereço preenchido automaticamente.');

                // Dispara evento para atualizar a interface
                $this->dispatch('cep-encontrado');
            } else {
                session()->flash('error', 'CEP não encontrado.');
                $this->limparCamposEndereco();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao buscar CEP. Verifique sua conexão com a internet.');
            \Log::error('Erro ao buscar CEP: ' . $e->getMessage());
        }
    }

    // Método auxiliar para limpar campos quando CEP não é encontrado
    private function limparCamposEndereco()
    {
        $this->funcionario['rua'] = '';
        $this->funcionario['bairro'] = '';
        $this->funcionario['cidade'] = '';
        $this->funcionario['estado'] = '';
    }

    // Método para buscar CEP manualmente (botão)
    public function buscarCepManual()
    {
        $this->buscarCep();
    }

    // Manter o método existente também
    public function updatedFuncionarioEhEstrangeiro()
    {
        // Limpa os campos de estrangeiro se não for estrangeiro
        if (!$this->funcionario['eh_estrangeiro']) {
            $this->funcionario['pais_origem'] = '';
            $this->funcionario['tipo_visto'] = '';
            $this->funcionario['data_chegada_brasil'] = '';
            $this->funcionario['casado_brasileiro'] = false;
            $this->funcionario['filhos_brasileiros'] = false;
        }
    }

    public function salvar()
    {
        $this->validate();

        try {
            // Remove campos vazios opcionais
            $dadosFuncionario = array_filter($this->funcionario, function ($value) {
                return $value !== '' && $value !== null;
            });

            $funcionario = Funcionario::create($dadosFuncionario);

            // Salva dependentes se existirem
            foreach ($this->dependentes as $dependente) {
                $dadosDependente = array_filter($dependente, function ($value) {
                    return $value !== '' && $value !== null;
                });

                if (!empty($dadosDependente)) {
                    $funcionario->dependentes()->create($dadosDependente);
                }
            }

            session()->flash('success', 'Funcionário cadastrado com sucesso!');

            // Redireciona ou reseta o formulário
            return redirect()->route('funcionarios.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao salvar funcionário: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['funcionario', 'dependentes']);
        $this->funcionario['eh_estrangeiro'] = false;
    }

    public function render()
    {
        return view('livewire.funcionario-form')
            ->layout('layouts.app');
    }
}
