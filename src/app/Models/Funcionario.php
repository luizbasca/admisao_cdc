<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        // Dados Pessoais
        'nome',
        'cpf',
        'data_nascimento',
        'pais_nascimento',
        'genero',
        'estado_civil',
        'raca_cor',
        'escolaridade',
        'deficiencia',

        // Documento de Identificação
        'tipo_documento',
        'numero_documento',
        'orgao_emissor',
        'data_emissao',
        'data_validade',

        // Endereço
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',

        // Funcionário Estrangeiro
        'eh_estrangeiro',
        'pais_origem',
        'tipo_visto',
        'data_chegada_brasil',
        'casado_brasileiro',
        'filhos_brasileiros',

        // Observação
        'observacao',

        // Concordância com a LGPD
        'concordancia_lgpd',
    ];

    protected $casts = [
        'eh_estrangeiro' => 'boolean',
        'data_nascimento' => 'date',
        'data_emissao' => 'date',
        'data_validade' => 'date',
        'data_chegada_brasil' => 'date',
        'casado_brasileiro' => 'boolean',
        'filhos_brasileiros' => 'boolean',
    ];

    public function dependentes()
    {
        return $this->hasMany(Dependente::class);
    }

    // Accessor para formatar CPF
    public function getCpfFormatadoAttribute()
    {
        if ($this->cpf) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->cpf);
        }
        return null;
    }

    // Accessor para formatar CEP
    public function getCepFormatadoAttribute()
    {
        if ($this->cep) {
            return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $this->cep);
        }
        return null;
    }

    // Método para verificar se é estrangeiro
    public function isEstrangeiro(): bool
    {
        return $this->eh_estrangeiro ||
            $this->data_chegada_brasil ||
            $this->casado_brasileiro ||
            $this->filhos_brasileiros;
    }

    // Método para formatar estado civil
    public function getEstadoCivilFormatado(): string
    {
        $estadosCivis = [
            'solteiro' => 'Solteiro',
            'casado' => 'Casado',
            'divorciado' => 'Divorciado',
            'viuvo' => 'Viúvo',
            'uniao_estavel' => 'União Estável',
            'outros' => 'Outros'
        ];

        return $estadosCivis[$this->estado_civil];
    }

    // Método para formatar raça/cor
    public function getRacaCorFormatada(): string
    {
        $racasCores = [
            'branco' => 'Branco',
            'negro' => 'Negro',
            'pardo' => 'Pardo',
            'amarelo' => 'Amarelo',
            'indigena' => 'Indígena',
            'nao_informado' => 'Não informado',
            'outros' => 'Outros'
        ];

        return $racasCores[$this->raca_cor];
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
            '01' => 'Nenhuma',
            '02' => 'Física',
            '03' => 'Auditiva',
            '04' => 'Visual',
            '05' => 'Intelectual',
            '06' => 'Múltipla',
            '07' => 'Reabilitado'
        ];

        $deficiencia = $deficiencias[$this->deficiencia];

        return $deficiencia;
    }

    // Método para formatar tipo de documento
    public function getTipoDocumentoFormatado(): string
    {
        $tiposDocumento = [
            'rg' => 'RG - Registro Geral',
            'cnh' => 'CNH - Carteira Nacional de Habilitação',
            'ctps' => 'CTPS - Carteira de Trabalho',
            'ric' => 'RIC - Registro de Identidade Civil'
        ];

        return $tiposDocumento[$this->tipo_documento];
    }

    // Método para endereço completo
    public function getEnderecoCompleto(): string
    {
        $endereco = "{$this->rua}, {$this->numero}";

        if ($this->complemento) {
            $endereco .= " - {$this->complemento}";
        }

        $endereco .= ", {$this->bairro}, {$this->cidade}/{$this->estado}";

        if ($this->cep) {
            $endereco .= " - CEP: {$this->getCepFormatadoAttribute()}";
        }

        return $endereco;
    }

    // Método para formatar gênero
    public function getGeneroFormatado(): string
    {
        return $this->genero === 'masculino' ? 'Masculino' : 'Feminino';
    }
}
