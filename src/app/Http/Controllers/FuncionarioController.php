<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Dependente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;

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
            'cpf' => 'required|cpf',
            'data_nascimento' => 'required|date|before:today',
            'pais_nascimento' => 'required|string|max:50',
            'genero' => 'required|in:masculino,feminino',
            'estado_civil' => 'required|in:solteiro,casado,divorciado,viuvo,uniao_estavel',
            'raca_cor' => 'required|in:branco,negro,pardo,amarelo,indigena,nao_informado',
            'escolaridade' => 'required|in:01,02,03,04,05,06,07,08,09,10,12,13',
            'deficiencia' => 'required|in:01,02,03,04,05,06,07',

            // Documento de Identificação - Obrigatórios
            'tipo_documento' => 'required|in:rg,cnh,ctps,ric',
            'numero_documento' => 'required|string|max:50',
            'orgao_emissor' => 'required|string|max:20',
            'data_emissao' => 'nullable|date',
            'data_validade' => 'nullable|date',

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
            'data_chegada_brasil' => 'required_if:eh_estrangeiro,true|date',
            'casado_brasileiro' => 'required_if:eh_estrangeiro,true|boolean',
            'filhos_brasileiros' => 'required_if:eh_estrangeiro,true|boolean',

            // Dependentes - incluindo os novos campos
            'possui_dependentes' => 'boolean',
            'dependentes' => 'nullable|array|max:5',
            'dependentes.*.nome_completo' => 'required_with:dependentes|string|max:100',
            'dependentes.*.cpf' => 'required_with:dependentes|cpf',
            'dependentes.*.data_nascimento' => 'required_with:dependentes|date|before:today',
            'dependentes.*.tipo_dependencia' => 'required_with:dependentes|in:filho_menor_21,filho_universitario,filho_deficiente,conjuge,companheiro,pais,outros',
            'dependentes.*.dependente_ir' => 'boolean',
            'dependentes.*.dependente_salario_familia' => 'boolean',
            'dependentes.*.dependente_plano_saude' => 'boolean',

            // Sindicato - Novos campos
            'filiado_sindicato' => 'required|boolean',
            'nome_sindicato' => 'required_if:filiado_sindicato,true|string|max:100',

            // Trabalho em Outra Empresa - Novos campos
            'trabalhando_outra_empresa' => 'required|boolean',
            'nome_outra_empresa' => 'required_if:trabalhando_outra_empresa,true|string|max:100',
            'salario_outra_empresa' => 'required_if:trabalhando_outra_empresa,true|numeric|min:0',

            // Observação
            'observacao' => 'nullable|string',

            // Concordância com a LGPD
            'concordancia_lgpd' => 'required|boolean',
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
            $validated['possui_dependentes'] = $validated['possui_dependentes'] ?? false;
            $validated['filiado_sindicato'] = $validated['filiado_sindicato'] ?? false;
            $validated['trabalhando_outra_empresa'] = $validated['trabalhando_outra_empresa'] ?? false;
            $validated['concordancia_lgpd'] = $validated['concordancia_lgpd'] ?? false;

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

                // Garantir valores padrão para campos booleanos dos dependentes
                $dependente['dependente_ir'] = $dependente['dependente_ir'] ?? false;
                $dependente['dependente_salario_familia'] = $dependente['dependente_salario_familia'] ?? false;
                $dependente['dependente_plano_saude'] = $dependente['dependente_plano_saude'] ?? false;

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
            // Dados Pessoais - Obrigatórios
            'nome' => 'required|string|max:100',
            'cpf' => 'required|cpf',
            'data_nascimento' => 'required|date|before:today',
            'pais_nascimento' => 'required|string|max:50',
            'genero' => 'required|in:masculino,feminino',
            'estado_civil' => 'required|in:solteiro,casado,divorciado,viuvo,uniao_estavel',
            'raca_cor' => 'required|in:branco,negro,pardo,amarelo,indigena,nao_informado',
            'escolaridade' => 'required|in:01,02,03,04,05,06,07,08,09,10,12,13',
            'deficiencia' => 'required|in:01,02,03,04,05,06,07',

            // Documento de Identificação
            'tipo_documento' => 'required|in:rg,cnh,ctps,ric',
            'numero_documento' => 'required|string|max:50',
            'orgao_emissor' => 'required|string|max:20',
            'data_emissao' => 'nullable|date',
            'data_validade' => 'nullable|date',

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
            'data_chegada_brasil' => 'required_if:eh_estrangeiro,true|date',
            'casado_brasileiro' => 'required_if:eh_estrangeiro,true|boolean',
            'filhos_brasileiros' => 'required_if:eh_estrangeiro,true|boolean',

            // Dependentes - incluindo os novos campos
            'possui_dependentes' => 'boolean',
            'dependentes' => 'nullable|array|max:5',
            'dependentes.*.nome_completo' => 'required_with:dependentes|string|max:100',
            'dependentes.*.cpf' => 'required_with:dependentes|cpf',
            'dependentes.*.data_nascimento' => 'required_with:dependentes|date|before:today',
            'dependentes.*.tipo_dependencia' => 'required_with:dependentes|in:filho_menor_21,filho_universitario,filho_deficiente,conjuge,companheiro,pais,outros',
            'dependentes.*.dependente_ir' => 'boolean',
            'dependentes.*.dependente_salario_familia' => 'boolean',
            'dependentes.*.dependente_plano_saude' => 'boolean',

            // Sindicato - Novos campos
            'filiado_sindicato' => 'required|boolean',
            'nome_sindicato' => 'required_if:filiado_sindicato,true|string|max:100',

            // Trabalho em Outra Empresa - Novos campos
            'trabalhando_outra_empresa' => 'required|boolean',
            'nome_outra_empresa' => 'required_if:trabalhando_outra_empresa,true|string|max:100',
            'salario_outra_empresa' => 'required_if:trabalhando_outra_empresa,true|numeric|min:0',

            // Observação
            'observacao' => 'nullable|string',

            // Concordância com a LGPD
            'concordancia_lgpd' => 'required|boolean',
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
            $validated['possui_dependentes'] = $validated['possui_dependentes'] ?? false;
            $validated['filiado_sindicato'] = $validated['filiado_sindicato'] ?? false;
            $validated['trabalhando_outra_empresa'] = $validated['trabalhando_outra_empresa'] ?? false;
            $validated['concordancia_lgpd'] = $validated['concordancia_lgpd'] ?? false;

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

                // Garantir valores padrão para campos booleanos dos dependentes
                $dependente['dependente_ir'] = $dependente['dependente_ir'] ?? false;
                $dependente['dependente_salario_familia'] = $dependente['dependente_salario_familia'] ?? false;
                $dependente['dependente_plano_saude'] = $dependente['dependente_plano_saude'] ?? false;

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

        $html = view('funcionarios.pdf', compact('funcionario'))->render();

        $pdf = Browsershot::html($html)
            ->setChromePath('/usr/bin/chromium')
            ->noSandbox()
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->waitUntilNetworkIdle()
            ->printBackground()
            ->showBackground()
            ->emulateMedia('print')
            ->pdf();

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="funcionario_' . $funcionario->id . '_' . date('Y-m-d') . '.pdf"');
    }
}
