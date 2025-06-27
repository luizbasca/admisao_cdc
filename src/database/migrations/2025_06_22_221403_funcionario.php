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

            // Dados Pessoais
            $table->string('nome', 100);
            $table->string('cpf', 14)->unique();
            $table->date('data_nascimento');
            $table->string('pais_nascimento')->default('Brasil');
            $table->enum('genero', ['masculino', 'feminino']);
            $table->enum('estado_civil', ['solteiro', 'casado', 'divorciado', 'viuvo', 'uniao_estavel', 'outros']);
            $table->string('outros_estado_texto', 50)->nullable();
            $table->enum('raca_cor', ['branco', 'negro', 'pardo', 'amarelo', 'indigena', 'nao_informado', 'outros']);
            $table->string('outros_raca_texto', 50)->nullable();
            $table->string('escolaridade', 2);
            $table->string('deficiencia', 2);
            $table->text('obs_deficiencia')->nullable();

            // Documento de Identificação
            $table->enum('tipo_documento', ['rg', 'cnh', 'ctps', 'ric']);
            $table->string('numero_documento', 50);
            $table->string('orgao_emissor', 20);
            $table->date('data_emissao')->nullable();
            $table->date('data_validade')->nullable();
            $table->text('info_adicionais')->nullable();

            // Endereço
            $table->string('cep', 9);
            $table->string('rua', 100);
            $table->string('numero', 10);
            $table->string('complemento')->nullable();
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->string('estado', 2);

            // Funcionário Estrangeiro
            $table->boolean('eh_estrangeiro')->default(false);
            $table->string('pais_origem', 50)->nullable();
            $table->string('tipo_visto', 50)->nullable();
            $table->string('numero_visto', 50)->nullable();
            $table->date('data_chegada_brasil')->nullable();
            $table->string('classificacao_trabalhador', 100)->nullable();
            $table->boolean('casado_brasileiro')->default(false); // Alterado de enum para boolean
            $table->boolean('filhos_brasileiros')->default(false); // Alterado nome e tipo


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
};
