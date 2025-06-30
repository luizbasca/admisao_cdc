<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Dependente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::with('dependentes')->latest()->paginate(10);
        return view('funcionarios.index', compact('funcionarios'));
    }

    public function create()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Dados Pessoais - Obrigatórios
            'nome' => 'required|string|max:100',
            'cpf' => 'required|cpf|unique:funcionarios,cpf',
            'data_nascimento' => 'required|date|before:today',
            'pais_nascimento' => 'required|string|max:50',
            'genero' => 'required|in:masculino,feminino',
            'estado_civil' => 'required|in:solteiro,casado,divorciado,viuvo,uniao_estavel,outros',
            'outros_estado_texto' => 'required_if:estado_civil,outros|max:50',
            'raca_cor' => 'required|in:branco,negro,pardo,amarelo,indigena,nao_informado,outros',
            'outros_raca_texto' => 'required_if:raca_cor,outros|max:50',
            'escolaridade' => 'required|in:01,02,03,04,05,06,07,08,09,10,12,13',
            'deficiencia' => 'required|in:01,02,03,04,05,06,07',

            // Documento de Identificação - Obrigatórios
            'tipo_documento' => 'required|in:rg,cnh,ctps,ric',
            'numero_documento' => 'required|string|max:50',
            'orgao_emissor' => 'required|string|max:20',
            'data_emissao' => 'nullable|date',
            'data_validade' => 'nullable|date',
            'info_adicionais' => 'nullable|string|max:255',

            // Endereço - Obrigatórios
            'cep' => 'required|string|size:9',
            'rua' => 'required|string|max:100',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:50',
            'bairro' => 'required|string|max:50',
            'cidade' => 'required|string|max:50',
            'estado' => 'required|string|size:2',

            // Funcionário Estrangeiro - Condicionais
            'eh_estrangeiro' => 'boolean',
            'pais_origem' => 'required_if:eh_estrangeiro,true|max:50',
            'tipo_visto' => 'required_if:eh_estrangeiro,true|max:50',
            'numero_visto' => 'required_if:eh_estrangeiro,true|max:50',
            'data_chegada_brasil' => 'required_if:eh_estrangeiro,true|date',
            'classificacao_trabalhador' => 'required_if:eh_estrangeiro,true|max:100',
            'casado_brasileiro' => 'boolean',
            'filhos_brasileiros' => 'boolean',

            // Dependentes
            'dependentes' => 'nullable|array|max:5',
            'dependentes.*.nome_completo' => 'required_with:dependentes|string|max:100',
            'dependentes.*.cpf' => 'nullable|cpf',
            'dependentes.*.data_nascimento' => 'required_with:dependentes|date|before:today',
            'dependentes.*.tipo_dependencia' => 'required_with:dependentes|in:filho_menor_21,filho_universitario,filho_deficiente,conjuge,companheiro,pais,outros',
            'dependentes.*.outros_especificar' => 'required_if:dependentes.*.tipo_dependencia,outros|max:100',
        ]);

        try {
            DB::beginTransaction();

            // Limpar formatação do CPF e CEP
            $validated['cpf'] = preg_replace('/[^0-9]/', '', $validated['cpf']);
            $validated['cep'] = preg_replace('/[^0-9-]/', '', $validated['cep']);

            // Garantir valores padrão para campos booleanos
            $validated['eh_estrangeiro'] = $validated['eh_estrangeiro'] ?? false;
            $validated['casado_brasileiro'] = $validated['casado_brasileiro'] ?? false;
            $validated['filhos_brasileiros'] = $validated['filhos_brasileiros'] ?? false;

            // Separar dados dos dependentes
            $dependentesData = $validated['dependentes'] ?? [];
            unset($validated['dependentes']);

            // Remove campos vazios opcionais
            $dadosFuncionario = array_filter($validated, function ($value) {
                return $value !== '' && $value !== null;
            });

            // Criar funcionário
            $funcionario = Funcionario::create($dadosFuncionario);

            // Criar dependentes se existirem
            foreach ($dependentesData as $dependente) {
                // Limpar CPF do dependente se fornecido
                if (!empty($dependente['cpf'])) {
                    $dependente['cpf'] = preg_replace('/[^0-9]/', '', $dependente['cpf']);
                }

                // Remove campos vazios opcionais
                $dadosDependente = array_filter($dependente, function ($value) {
                    return $value !== '' && $value !== null;
                });

                if (!empty($dadosDependente)) {
                    $funcionario->dependentes()->create($dadosDependente);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Funcionário cadastrado com sucesso!',
                'redirect' => route('funcionarios.pdf', $funcionario->id)
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar funcionário: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Funcionario $funcionario)
    {
        $funcionario->load('dependentes');
        return view('funcionarios.show', compact('funcionario'));
    }

    public function edit(Funcionario $funcionario)
    {
        $funcionario->load('dependentes');
        return view('funcionarios.edit', compact('funcionario'));
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $validated = $request->validate([
            // Mesmas validações do store, mas sem unique no CPF se for o mesmo funcionário
            'nome' => 'required|string|max:100',
            'cpf' => 'required|cpf|unique:funcionarios,cpf,' . $funcionario->id,
            'data_nascimento' => 'required|date|before:today',
            'pais_nascimento' => 'required|string|max:50',
            'genero' => 'required|in:masculino,feminino',
            'estado_civil' => 'required|in:solteiro,casado,divorciado,viuvo,uniao_estavel,outros',
            'outros_estado_texto' => 'required_if:estado_civil,outros|max:50',
            'raca_cor' => 'required|in:branco,negro,pardo,amarelo,indigena,nao_informado,outros',
            'outros_raca_texto' => 'required_if:raca_cor,outros|max:50',
            'escolaridade' => 'required|in:01,02,03,04,05,06,07,08,09,10,12,13',
            'deficiencia' => 'required|in:01,02,03,04,05,06,07',

            // Documento de Identificação
            'tipo_documento' => 'required|in:rg,cnh,ctps,ric',
            'numero_documento' => 'required|string|max:50',
            'orgao_emissor' => 'required|string|max:20',
            'data_emissao' => 'nullable|date',
            'data_validade' => 'nullable|date',
            'info_adicionais' => 'nullable|string|max:255',

            // Endereço
            'cep' => 'required|string|size:9',
            'rua' => 'required|string|max:100',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:50',
            'bairro' => 'required|string|max:50',
            'cidade' => 'required|string|max:50',
            'estado' => 'required|string|size:2',

            // Funcionário Estrangeiro
            'eh_estrangeiro' => 'boolean',
            'pais_origem' => 'required_if:eh_estrangeiro,true|max:50',
            'tipo_visto' => 'required_if:eh_estrangeiro,true|max:50',
            'numero_visto' => 'required_if:eh_estrangeiro,true|max:50',
            'data_chegada_brasil' => 'required_if:eh_estrangeiro,true|date',
            'classificacao_trabalhador' => 'required_if:eh_estrangeiro,true|max:100',
            'casado_brasileiro' => 'boolean',
            'filhos_brasileiros' => 'boolean',

            // Dependentes
            'dependentes' => 'nullable|array|max:5',
            'dependentes.*.nome_completo' => 'required_with:dependentes|string|max:100',
            'dependentes.*.cpf' => 'nullable|cpf',
            'dependentes.*.data_nascimento' => 'required_with:dependentes|date|before:today',
            'dependentes.*.tipo_dependencia' => 'required_with:dependentes|in:filho_menor_21,filho_universitario,filho_deficiente,conjuge,companheiro,pais,outros',
            'dependentes.*.outros_especificar' => 'required_if:dependentes.*.tipo_dependencia,outros|max:100',
        ]);

        try {
            DB::beginTransaction();

            // Limpar formatação do CPF e CEP
            $validated['cpf'] = preg_replace('/[^0-9]/', '', $validated['cpf']);
            $validated['cep'] = preg_replace('/[^0-9-]/', '', $validated['cep']);

            // Garantir valores padrão para campos booleanos
            $validated['eh_estrangeiro'] = $validated['eh_estrangeiro'] ?? false;
            $validated['casado_brasileiro'] = $validated['casado_brasileiro'] ?? false;
            $validated['filhos_brasileiros'] = $validated['filhos_brasileiros'] ?? false;

            // Separar dados dos dependentes
            $dependentesData = $validated['dependentes'] ?? [];
            unset($validated['dependentes']);

            // Remove campos vazios opcionais
            $dadosFuncionario = array_filter($validated, function ($value) {
                return $value !== '' && $value !== null;
            });

            // Atualizar funcionário
            $funcionario->update($dadosFuncionario);

            // Remover dependentes existentes e recriar
            $funcionario->dependentes()->delete();

            // Criar novos dependentes
            foreach ($dependentesData as $dependente) {
                if (!empty($dependente['cpf'])) {
                    $dependente['cpf'] = preg_replace('/[^0-9]/', '', $dependente['cpf']);
                }

                $dadosDependente = array_filter($dependente, function ($value) {
                    return $value !== '' && $value !== null;
                });

                if (!empty($dadosDependente)) {
                    $funcionario->dependentes()->create($dadosDependente);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Funcionário atualizado com sucesso!',
                'redirect' => route('funcionarios.show', $funcionario->id)
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar funcionário: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Funcionario $funcionario)
    {
        try {
            $funcionario->delete();
            return redirect()->route('funcionarios.index')
                ->with('success', 'Funcionário excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('funcionarios.index')
                ->with('error', 'Erro ao excluir funcionário.');
        }
    }

    public function gerarPDF(Funcionario $funcionario)
    {
        $funcionario->load('dependentes');

        $pdf = PDF::loadView('funcionarios.pdf', compact('funcionario'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('funcionario_' . $funcionario->id . '_' . date('Y-m-d') . '.pdf');
    }
}
