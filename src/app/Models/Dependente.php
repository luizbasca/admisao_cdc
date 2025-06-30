<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependente extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcionario_id',
        'nome_completo',
        'cpf',
        'data_nascimento',
        'tipo_dependencia',
        'outros_dependencia',
        'dependente_ir',
        'dependente_salario_familia',
        'dependente_plano_saude'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'dependente_ir' => 'boolean',
        'dependente_salario_familia' => 'boolean',
        'dependente_plano_saude' => 'boolean',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    // Accessor para formatar CPF
    public function getCpfFormatadoAttribute()
    {
        if ($this->cpf) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->cpf);
        }
        return null;
    }

    // Método para formatar tipo de dependência
    public function getTipoDependenciaFormatada(): string
    {
        $tiposDependencia = [
            'filho_menor_21' => 'Filho(a) menor de 21 anos',
            'filho_universitario' => 'Filho(a) universitário até 24 anos',
            'filho_deficiente' => 'Filho(a) com deficiência',
            'conjuge' => 'Cônjuge',
            'companheiro' => 'Companheiro(a)',
            'pais' => 'Pais',
            'outros' => 'Outros'
        ];

        $tipoDependencia = $tiposDependencia[$this->tipo_dependencia] ?? 'Não informado';

        if ($this->tipo_dependencia === 'outros' && $this->outros_dependencia) {
            $tipoDependencia .= " ({$this->outros_dependencia})";
        }

        return $tipoDependencia;
    }

    // Método para calcular idade
    public function getIdade(): int
    {
        if ($this->data_nascimento) {
            return $this->data_nascimento->age;
        }
        return 0;
    }

    // Método para verificar se é menor de idade
    public function isMenorIdade(): bool
    {
        return $this->getIdade() < 18;
    }

    // Método para verificar se pode ser dependente por idade
    public function podeSerDependentePorIdade(): bool
    {
        $idade = $this->getIdade();

        switch ($this->tipo_dependencia) {
            case 'filho_menor_21':
                return $idade < 21;
            case 'filho_universitario':
                return $idade <= 24;
            case 'filho_deficiente':
                return true; // Não há limite de idade para filhos com deficiência
            default:
                return true; // Para outros tipos, não verificamos idade
        }
    }

    // Métodos para formatar as respostas das perguntas
    public function getDependenteIrFormatado(): string
    {
        return $this->dependente_ir ? 'Sim' : 'Não';
    }

    public function getDependenteSalarioFamiliaFormatado(): string
    {
        return $this->dependente_salario_familia ? 'Sim' : 'Não';
    }

    public function getDependentePlanoSaudeFormatado(): string
    {
        return $this->dependente_plano_saude ? 'Sim' : 'Não';
    }
}
