<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();

            // Dados do Funcionário
            $table->string('nome_completo', 100);
            $table->string('cpf', 14)->unique();
            $table->date('data_nascimento');
            $table->string('pais_nascimento');
            $table->enum('genero', ['masculino', 'feminino']);
            $table->enum('estado_civil', ['solteiro', 'casado', 'divorciado', 'viuvo', 'uniao_estavel', 'outros']);
            $table->string('outros_estado_texto')->nullable();
            $table->enum('raca_cor', ['branco', 'negro', 'pardo', 'amarelo', 'indigena', 'nao_informado'])->nullable();
            $table->string('escolaridade', 2)->nullable();
            $table->string('deficiencia', 2)->nullable();

            // Documento de Identificação
            $table->enum('tipo_documento', ['rg', 'cnh', 'ric', 'rne']);
            $table->string('numero_documento');
            $table->string('orgao_emissor');
            $table->date('data_emissao')->nullable();
            $table->date('data_validade')->nullable();

            // Endereço
            $table->string('rua');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado', 2);
            $table->string('cep', 9);

            // Funcionário Estrangeiro
            $table->date('data_chegada_brasil')->nullable();
            $table->date('data_naturalizacao')->nullable();
            $table->enum('casado_brasileiro', ['sim', 'nao'])->nullable();
            $table->enum('filho_brasileiro', ['sim', 'nao'])->nullable();

            // Observação
            $table->text('observacao')->nullable();


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
};
