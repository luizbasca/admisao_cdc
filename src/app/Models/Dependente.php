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
        'outros_dependencia'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function getCpfFormatadoAttribute()
    {
        if ($this->cpf) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->cpf);
        }
        return null;
    }
}
