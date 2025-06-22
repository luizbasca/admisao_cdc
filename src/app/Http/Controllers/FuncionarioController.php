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
            'nome_completo' => 'required|string|max:100',
            'cpf' => 'required|string|unique:funcionarios,cpf',
            'data_nascimento' => 'required|date',
            'genero' => 'required|in:masculino,feminino',
            'estado_civil' => 'required|in:solteiro,casado,divorciado,viuvo,separado,uniao_estavel,outros',
            'outros_estado_texto' => 'nullable|string|max:50',
            'pais_nascimento' => 'nullable|string|max:50',
            'raca_cor' => 'nullable|in:branca,preta,parda,amarela,indigena,negro', // Adicionado 'negro'
            'escolaridade' => 'nullable|in:01,02,03,04,05,06,07,08,09,10,12,13',
            'deficiencia' => 'nullable|in:01,02,03,04,05,06',
            'obs_deficiencia' => 'nullable|string|max:255',

            // Documento
            'tipo_documento' => 'required|in:rg,cnh,ctps,passaporte,ric,rne',
            'numero_documento' => 'required|string|max:20',
            'orgao_emissor' => 'required|string|max:10',
            'data_emissao' => 'nullable|date',
            'data_validade' => 'nullable|date',
            'info_adicionais' => 'nullable|string|max:255',

            // Endereço - TODOS OBRIGATÓRIOS
            'cep' => 'required|string',
            'rua' => 'required|string|max:100',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:50',
            'bairro' => 'required|string|max:50',
            'cidade' => 'required|string|max:50',
            'estado' => 'required|string|size:2',

            // Dados de estrangeiro (opcionais)
            'data_chegada_brasil' => 'nullable|date',
            'data_naturalizacao' => 'nullable|date',
            'casado_brasileiro' => 'nullable|in:sim,nao',
            'filho_brasileiro' => 'nullable|in:sim,nao',

            // Dependentes
            'dependentes' => 'nullable|array',
            'dependentes.*.nome_completo' => 'required_with:dependentes|string|max:100',
            'dependentes.*.cpf' => 'nullable|string',
            'dependentes.*.data_nascimento' => 'required_with:dependentes|date',
            'dependentes.*.tipo_dependencia' => 'required_with:dependentes|in:conjuge,filho,enteado,menor_tutela,pais,outros',
            'dependentes.*.outros_dependencia' => 'nullable|string|max:50',
        ]);

        try {
            DB::beginTransaction();

            // Limpar formatação do CPF e CEP
            $validated['cpf'] = preg_replace('/[^0-9]/', '', $validated['cpf']);
            $validated['cep'] = preg_replace('/[^0-9]/', '', $validated['cep']);

            // Criar funcionário
            $funcionario = Funcionario::create($validated);

            // Criar dependentes se existirem
            if (isset($validated['dependentes'])) {
                foreach ($validated['dependentes'] as $dependenteData) {
                    if (!empty($dependenteData['cpf'])) {
                        $dependenteData['cpf'] = preg_replace('/[^0-9]/', '', $dependenteData['cpf']);
                    }
                    $funcionario->dependentes()->create($dependenteData);
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
        // Similar ao store, mas para atualização
        // Implementar conforme necessário
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
