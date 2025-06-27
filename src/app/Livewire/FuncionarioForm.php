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
        'pais_nascimento' => 'Brasil',
        'genero' => '',
        'estado_civil' => '',
        'outros_estado_texto' => '',
        'raca_cor' => '',
        'outros_raca_texto' => '',
        'escolaridade' => '',
        'deficiencia' => '',
        'obs_deficiencia' => '',

        // Documento de Identificação
        'tipo_documento' => '',
        'numero_documento' => '',
        'orgao_emissor' => '',
        'data_emissao' => '',
        'data_validade' => '',
        'info_adicionais' => '',

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
        'numero_visto' => '',
        'data_chegada_brasil' => '',
        'classificacao_trabalhador' => '',
        'casado_brasileiro' => false,
        'filhos_brasileiros' => false,
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
        'funcionario.numero_visto' => 'required_if:funcionario.eh_estrangeiro,true|max:50',
        'funcionario.data_chegada_brasil' => 'required_if:funcionario.eh_estrangeiro,true|date',
        'funcionario.classificacao_trabalhador' => 'required_if:funcionario.eh_estrangeiro,true|max:100',

        // Dependentes
        'dependentes.*.nome_completo' => 'required|string|max:100',
        'dependentes.*.cpf' => 'nullable|cpf',
        'dependentes.*.data_nascimento' => 'required|date|before:today',
        'dependentes.*.tipo_dependencia' => 'required|string',
        'dependentes.*.outros_especificar' => 'required_if:dependentes.*.tipo_dependencia,outros|max:100',
    ];

    protected $messages = [
        'funcionario.nome.required' => 'O nome é obrigatório.',
        'funcionario.cpf.required' => 'O CPF é obrigatório.',
        'funcionario.cpf.cpf' => 'O CPF deve ser válido.',
        'funcionario.cpf.unique' => 'Este CPF já está cadastrado.',
        'funcionario.data_nascimento.required' => 'A data de nascimento é obrigatória.',
        'funcionario.data_nascimento.before' => 'A data de nascimento deve ser anterior a hoje.',
        'funcionario.genero.required' => 'O gênero é obrigatório.',
        'funcionario.cep.required' => 'O CEP é obrigatório.',
        'funcionario.cep.size' => 'O CEP deve ter 9 caracteres (formato: 00000-000).',
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
            'outros_especificar' => ''
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

        try {
            $response = file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
            $data = json_decode($response, true);

            if (!isset($data['erro'])) {
                $this->funcionario['rua'] = $data['logradouro'] ?? '';
                $this->funcionario['bairro'] = $data['bairro'] ?? '';
                $this->funcionario['cidade'] = $data['localidade'] ?? '';
                $this->funcionario['estado'] = $data['uf'] ?? '';

                session()->flash('success', 'Endereço preenchido automaticamente.');
            } else {
                session()->flash('error', 'CEP não encontrado.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao buscar CEP. Verifique sua conexão.');
        }
    }

    public function updatedFuncionarioEhEstrangeiro()
    {
        // Limpa os campos de estrangeiro se não for estrangeiro
        if (!$this->funcionario['eh_estrangeiro']) {
            $this->funcionario['pais_origem'] = '';
            $this->funcionario['tipo_visto'] = '';
            $this->funcionario['numero_visto'] = '';
            $this->funcionario['data_chegada_brasil'] = '';
            $this->funcionario['classificacao_trabalhador'] = '';
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
        $this->funcionario['pais_nascimento'] = 'Brasil';
        $this->funcionario['eh_estrangeiro'] = false;
    }

    public function render()
    {
        return view('livewire.funcionario-form')
            ->layout('layouts.app');
    }
}
