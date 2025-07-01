<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Funcionario;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class FuncionarioForm extends Component
{
    public $funcionario = [];
    public $dependentes = [];
    public $maxDependentes = 5;
    public $funcionarioId = null;

    // Constantes para opções de select
    private const ESTADOS_CIVIS = [
        'solteiro' => 'Solteiro',
        'casado' => 'Casado',
        'divorciado' => 'Divorciado',
        'viuvo' => 'Viúvo',
        'uniao_estavel' => 'União Estável',
    ];

    private const RACAS_CORES = [
        'branco' => 'Branco',
        'negro' => 'Negro',
        'pardo' => 'Pardo',
        'amarelo' => 'Amarelo',
        'indigena' => 'Indígena',
        'nao_informado' => 'Não informado',
    ];

    private const ESCOLARIDADES = [
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

    private const TIPOS_DEFICIENCIA = [
        '01' => 'Nenhuma',
        '02' => 'Física',
        '03' => 'Auditiva',
        '04' => 'Visual',
        '05' => 'Intelectual',
        '06' => 'Múltipla',
        '07' => 'Reabilitado'
    ];

    private const TIPOS_DOCUMENTO = [
        'rg' => 'RG - Registro Geral',
        'cnh' => 'CNH - Carteira Nacional de Habilitação',
        'ctps' => 'CTPS - Carteira de Trabalho',
        'ric' => 'RIC - Registro de Identidade Civil',
    ];

    private const ESTADOS_BRASIL = [
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

    private const TIPOS_DEPENDENCIA = [
        'filho_menor_21' => 'Filho(a) menor de 21 anos',
        'filho_universitario' => 'Filho(a) universitário até 24 anos',
        'filho_deficiente' => 'Filho(a) com deficiência',
        'conjuge' => 'Cônjuge',
        'companheiro' => 'Companheiro(a)',
        'pais' => 'Pais',
        'outros' => 'Outros'
    ];

    // Getters para acessar as constantes nas views
    public function getEstadosCivisProperty()
    {
        return self::ESTADOS_CIVIS;
    }
    public function getRacasCoresProperty()
    {
        return self::RACAS_CORES;
    }
    public function getEscolaridadesProperty()
    {
        return self::ESCOLARIDADES;
    }
    public function getTiposDeficienciaProperty()
    {
        return self::TIPOS_DEFICIENCIA;
    }
    public function getTiposDocumentoProperty()
    {
        return self::TIPOS_DOCUMENTO;
    }
    public function getEstadosBrasilProperty()
    {
        return self::ESTADOS_BRASIL;
    }
    public function getTiposDependenciaProperty()
    {
        return self::TIPOS_DEPENDENCIA;
    }

    protected function rules()
    {
        $rules = [
            // Dados Pessoais - Obrigatórios
            'funcionario.nome' => 'required|string|max:100',
            'funcionario.cpf' => ['required', 'cpf'],
            'funcionario.data_nascimento' => 'required|date|before:today',
            'funcionario.genero' => 'required|in:masculino,feminino',
            'funcionario.estado_civil' => 'required',
            'funcionario.pais_nascimento' => 'required|string',
            'funcionario.raca_cor' => 'required',
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
            'funcionario.casado_brasileiro' => 'required_if:funcionario.eh_estrangeiro,true|boolean',
            'funcionario.filhos_brasileiros' => 'required_if:funcionario.eh_estrangeiro,true|boolean',

            // Dependentes
            'dependentes.*.nome_completo' => 'required|string|max:100',
            'dependentes.*.cpf' => 'required|cpf',
            'dependentes.*.data_nascimento' => 'required|date|before:today',
            'dependentes.*.tipo_dependencia' => 'required|string',

            // Observação
            'funcionario.observacao' => 'nullable|string',

            // Concordância com a LGPD
            'funcionario.concordancia_lgpd' => 'required|accepted',
        ];

        return $rules;
    }

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
        'funcionario.pais_nascimento.required' => 'O país de nascimento é obrigatório.',
        'funcionario.genero.in' => 'O gênero deve ser masculino ou feminino.',
        'funcionario.estado_civil.required' => 'O estado civil é obrigatório.',
        'funcionario.raca_cor.required' => 'A raça/cor é obrigatória.',
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
        'funcionario.rua.required' => 'O logradouro é obrigatório.',
        'funcionario.rua.max' => 'O logradouro deve ter no máximo 100 caracteres.',
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
        'funcionario.casado_brasileiro.required_if' => 'É obrigatório informar se é casado(a) com brasileiro(a) para funcionários estrangeiros.',
        'funcionario.filhos_brasileiros.required_if' => 'É obrigatório informar se possui filhos brasileiros para funcionários estrangeiros.',

        // Dependentes
        'dependentes.*.nome_completo.required' => 'O nome completo do dependente é obrigatório.',
        'dependentes.*.nome_completo.max' => 'O nome completo do dependente deve ter no máximo 100 caracteres.',
        'dependentes.*.cpf.cpf' => 'O CPF do dependente deve ser válido.',
        'dependentes.*.cpf.required' => 'O CPF do dependente é obrigatório.',
        'dependentes.*.data_nascimento.required' => 'A data de nascimento do dependente é obrigatória.',
        'dependentes.*.data_nascimento.date' => 'A data de nascimento do dependente deve ser uma data válida.',
        'dependentes.*.data_nascimento.before' => 'A data de nascimento do dependente deve ser anterior a hoje.',
        'dependentes.*.tipo_dependencia.required' => 'O tipo de dependência é obrigatório.',

        // LGPD
        'funcionario.concordancia_lgpd.required' => 'É obrigatório concordar com os termos da LGPD.',
        'funcionario.concordancia_lgpd.accepted' => 'É obrigatório concordar com os termos da LGPD.',
    ];

    public function mount($funcionarioId = null)
    {
        $this->funcionarioId = $funcionarioId;
        $this->initializeFuncionario();

        if ($funcionarioId) {
            $this->loadFuncionario($funcionarioId);
        }
    }

    /**
     * Inicializa os dados padrão do funcionário
     */
    private function initializeFuncionario()
    {
        $this->funcionario = [
            // Dados Pessoais
            'nome' => '',
            'cpf' => '',
            'data_nascimento' => '',
            'pais_nascimento' => '',
            'genero' => '',
            'estado_civil' => '',
            'raca_cor' => '',
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
            'casado_brasileiro' => '',
            'filhos_brasileiros' => '',

            // Observações
            'observacao' => '',

            // Concordância com a LGPD
            'concordancia_lgpd' => '',
        ];
    }

    /**
     * Carrega dados do funcionário para edição
     */
    private function loadFuncionario($funcionarioId)
    {
        try {
            $funcionario = Funcionario::with('dependentes')->findOrFail($funcionarioId);
            $this->funcionario = array_merge($this->funcionario, $funcionario->toArray());
            $this->dependentes = $funcionario->dependentes->toArray();
        } catch (\Exception $e) {
            session()->flash('error', 'Funcionário não encontrado.');
            return redirect()->route('funcionarios.index');
        }
    }

    public function adicionarDependente()
    {
        if (count($this->dependentes) >= $this->maxDependentes) {
            $this->addError('dependentes', "Máximo de {$this->maxDependentes} dependentes permitidos.");
            return;
        }

        $this->dependentes[] = [
            'nome_completo' => '',
            'cpf' => '',
            'data_nascimento' => '',
            'tipo_dependencia' => '',
            'dependente_ir' => '',
            'dependente_salario_familia' => '',
            'dependente_plano_saude' => ''
        ];

        $this->dispatch('dependente-adicionado');
    }

    public function removerDependente($index)
    {
        if (isset($this->dependentes[$index])) {
            unset($this->dependentes[$index]);
            $this->dependentes = array_values($this->dependentes);
            session()->flash('success', 'Dependente removido com sucesso.');
            $this->dispatch('dependente-removido');
        }
    }

    public function buscarCep()
    {
        $cep = preg_replace('/\D/', '', $this->funcionario['cep'] ?? '');

        if (strlen($cep) !== 8) {
            $this->addError('funcionario.cep', 'CEP deve ter 8 dígitos.');
            return;
        }

        try {
            $response = Http::timeout(10)->get("https://viacep.com.br/ws/{$cep}/json/");

            if (!$response->successful()) {
                throw new \Exception('Erro na consulta do CEP');
            }

            $data = $response->json();

            if (isset($data['erro'])) {
                $this->addError('funcionario.cep', 'CEP não encontrado.');
                $this->limparEndereco();
                return;
            }

            $this->preencherEndereco($data, $cep);
            session()->flash('success', 'Endereço preenchido automaticamente.');
            $this->dispatch('cep-encontrado');
        } catch (\Exception $e) {
            $this->addError('funcionario.cep', 'Erro ao buscar CEP. Verifique sua conexão com a internet.');
            Log::error('Erro ao buscar CEP: ' . $e->getMessage());
        }
    }

    /**
     * Preenche os campos de endereço com os dados do CEP
     */
    private function preencherEndereco($data, $cep)
    {
        $this->funcionario['rua'] = $data['logradouro'] ?? '';
        $this->funcionario['bairro'] = $data['bairro'] ?? '';
        $this->funcionario['cidade'] = $data['localidade'] ?? '';
        $this->funcionario['estado'] = $data['uf'] ?? '';
        $this->funcionario['cep'] = substr($cep, 0, 5) . '-' . substr($cep, 5);

        // Limpa erros dos campos preenchidos
        $this->resetErrorBag(['funcionario.rua', 'funcionario.bairro', 'funcionario.cidade', 'funcionario.estado']);
    }

    /**
     * Limpa os campos de endereço
     */
    private function limparEndereco()
    {
        $this->funcionario['rua'] = '';
        $this->funcionario['bairro'] = '';
        $this->funcionario['cidade'] = '';
        $this->funcionario['estado'] = '';
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    /**
     * Busca CEP automaticamente quando preenchido
     */
    public function updatedFuncionarioCep()
    {
        $cep = preg_replace('/\D/', '', $this->funcionario['cep'] ?? '');

        if (strlen($cep) === 8) {
            $this->buscarCep();
        }
    }

    /**
     * Limpa campos de estrangeiro quando não aplicável
     */
    public function updatedFuncionarioEhEstrangeiro()
    {
        if (!$this->funcionario['eh_estrangeiro']) {
            $camposEstrangeiro = [
                'pais_origem',
                'tipo_visto',
                'data_chegada_brasil',
                'casado_brasileiro',
                'filhos_brasileiros'
            ];

            foreach ($camposEstrangeiro as $campo) {
                $this->funcionario[$campo] = '';
            }

            // Limpa erros dos campos de estrangeiro
            $this->resetErrorBag(array_map(fn($campo) => "funcionario.{$campo}", $camposEstrangeiro));
        }
    }

    public function salvar()
    {
        $this->validate();

        try {
            $dadosFuncionario = $this->prepararDadosFuncionario();

            if ($this->funcionarioId) {
                $funcionario = Funcionario::findOrFail($this->funcionarioId);
                $funcionario->update($dadosFuncionario);
                $this->atualizarDependentes($funcionario);
                $mensagem = 'Funcionário atualizado com sucesso!';
            } else {
                $funcionario = Funcionario::create($dadosFuncionario);
                $this->salvarDependentes($funcionario);
                $mensagem = 'Funcionário cadastrado com sucesso!';
            }

            session()->flash('success', $mensagem);
            return redirect()->route('funcionarios.index');
        } catch (\Exception $e) {
            Log::error('Erro ao salvar funcionário: ' . $e->getMessage());
            session()->flash('error', 'Erro ao salvar funcionário: ' . $e->getMessage());
        }
    }

    /**
     * Prepara dados do funcionário removendo campos vazios
     */
    private function prepararDadosFuncionario(): array
    {
        return array_filter($this->funcionario, function ($value) {
            return $value !== '' && $value !== null;
        });
    }

    /**
     * Salva dependentes para novo funcionário
     */
    private function salvarDependentes($funcionario)
    {
        foreach ($this->dependentes as $dependente) {
            $dadosDependente = array_filter($dependente, function ($value) {
                return $value !== '' && $value !== null;
            });

            if (!empty($dadosDependente)) {
                $funcionario->dependentes()->create($dadosDependente);
            }
        }
    }

    /**
     * Atualiza dependentes para funcionário existente
     */
    private function atualizarDependentes($funcionario)
    {
        // Remove dependentes existentes
        $funcionario->dependentes()->delete();

        // Adiciona novos dependentes
        $this->salvarDependentes($funcionario);
    }

    public function resetForm()
    {
        $this->reset(['dependentes', 'funcionarioId']);
        $this->initializeFuncionario();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.funcionario-form')
            ->layout('layouts.app');
    }
}
