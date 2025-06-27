<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_completo',
        'cpf',
        'data_nascimento',
        'pais_nascimento',
        'genero',
        'estado_civil',
        'outros_estado_texto',
        'raca_cor',
        'escolaridade',
        'deficiencia',
        'obs_deficiencia',
        'tipo_documento',
        'numero_documento',
        'orgao_emissor',
        'data_emissao',
        'data_validade',
        'info_adicionais',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'data_chegada_brasil',
        'data_naturalizacao',
        'casado_brasileiro',
        'filho_brasileiro'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_emissao' => 'date',
        'data_validade' => 'date',
        'data_chegada_brasil' => 'date',
        'data_naturalizacao' => 'date',
    ];

    public function dependentes()
    {
        return $this->hasMany(Dependente::class);
    }

    // Accessor para formatar CPF
    public function getCpfFormatadoAttribute()
    {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->cpf);
    }

    // Accessor para formatar CEP
    public function getCepFormatadoAttribute()
    {
        return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $this->cep);
    }

    // Método para verificar se é estrangeiro
    public function isEstrangeiro(): bool
    {
        return $this->data_chegada_brasil ||
            $this->data_naturalizacao ||
            $this->casado_brasileiro ||
            $this->filho_brasileiro;
    }

    // Método para formatar estado civil
    public function getEstadoCivilFormatado(): string
    {
        $estadoCivil = ucfirst(str_replace('_', ' ', $this->estado_civil));

        if ($this->estado_civil === 'outros' && $this->outros_estado_texto) {
            $estadoCivil .= " ({$this->outros_estado_texto})";
        }

        return $estadoCivil;
    }

    // Método para formatar escolaridade
    public function getEscolaridadeFormatada(): string
    {
        $escolaridades = [
            '01' => 'Analfabeto',
            '02' => 'Até 4ª série incompleta (EF)',
            '03' => '4ª série completa (EF)',
            '04' => 'De 5ª a 8ª série (EF)',
            '05' => 'Ensino Fundamental Completo',
            '06' => 'Ensino Médio Incompleto',
            '07' => 'Ensino Médio Completo',
            '08' => 'Ensino Superior Incompleto',
            '09' => 'Ensino Superior Completo',
            '10' => 'Pós Graduação',
            '12' => 'Doutorado',
            '13' => 'Outros'
        ];

        return $escolaridades[$this->escolaridade] ?? 'Não informado';
    }

    // Método para formatar deficiência
    public function getDeficienciaFormatada(): string
    {
        $deficiencias = [
            '01' => 'Não tenho Deficiência',
            '02' => 'Auditiva',
            '03' => 'Visual',
            '04' => 'Intelectual',
            '05' => 'Mental',
            '06' => 'Reabilitado'
        ];

        return $deficiencias[$this->deficiencia] ?? 'Não informado';
    }

    // Método para endereço completo
    public function getEnderecoCompleto(): string
    {
        $endereco = "{$this->rua}, {$this->numero}";

        if ($this->complemento) {
            $endereco .= " - {$this->complemento}";
        }

        return $endereco;
    }
}
