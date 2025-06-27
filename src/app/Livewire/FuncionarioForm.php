<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Funcionario;

class FuncionarioForm extends Component
{
    public $funcionario = [
        'nome' => '',
        'cpf' => '',
        'cep' => '',
        'rua' => '',
        'numero' => '',
        'bairro' => '',
        'cidade' => '',
        'estado' => ''
    ];

    public $dependentes = [];
    public $maxDependentes = 5;

    protected $rules = [
        'funcionario.nome' => 'required|string|max:100',
        'funcionario.cpf' => 'required|cpf',
        'funcionario.cep' => 'required|string|size:9',
        'dependentes.*.nome_completo' => 'required|string|max:100',
        'dependentes.*.cpf' => 'nullable|cpf',
        'dependentes.*.data_nascimento' => 'required|date',
        'dependentes.*.tipo_dependencia' => 'required|string',
    ];

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
    }

    public function updatedFuncionarioCep()
    {
        if (strlen(preg_replace('/\D/', '', $this->funcionario['cep'])) == 8) {
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
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao buscar CEP');
        }
    }

    public function salvar()
    {
        $this->validate();

        try {
            $funcionario = Funcionario::create($this->funcionario);

            foreach ($this->dependentes as $dependente) {
                $funcionario->dependentes()->create($dependente);
            }

            session()->flash('success', 'Funcionário cadastrado com sucesso!');
            $this->reset();
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao salvar funcionário');
        }
    }

    public function render()
    {
        return view('livewire.funcionario-form');
    }
}
