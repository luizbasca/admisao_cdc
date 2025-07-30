
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

            // Token único para acesso seguro
            $table->string('token', 64)->unique()->index();

            // Dados Pessoais
            $table->string('nome', 100);
            $table->string('cpf', 14);
            $table->date('data_nascimento');
            $table->string('pais_nascimento');
            $table->enum('genero', ['masculino', 'feminino']);
            $table->enum('estado_civil', ['solteiro', 'casado', 'divorciado', 'viuvo', 'uniao_estavel']);
            $table->enum('raca_cor', ['branco', 'negro', 'pardo', 'amarelo', 'indigena', 'nao_informado']);
            $table->string('escolaridade', 2);
            $table->string('deficiencia', 2);

            // Documento de Identificação
            $table->enum('tipo_documento', ['rg', 'cnh', 'ctps', 'ric']);
            $table->string('numero_documento', 50);
            $table->string('orgao_emissor', 20);
            $table->date('data_emissao')->nullable();
            $table->date('data_validade')->nullable();

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
            $table->date('data_chegada_brasil')->nullable();
            $table->boolean('casado_brasileiro')->default(false);
            $table->boolean('filhos_brasileiros')->default(false);

            // Dependentes
            $table->boolean('possui_dependentes')->default(false);

            // Dados do Sindicato
            $table->boolean('filiado_sindicato')->default(false);
            $table->string('nome_sindicato', 100)->nullable();

            // Vínculo Empregatício - Trabalho em Outra Empresa
            $table->boolean('trabalhando_outra_empresa')->default(false);
            $table->string('nome_outra_empresa', 100)->nullable();
            $table->decimal('salario_outra_empresa', 10, 2)->nullable();

            // Observações	
            $table->text('observacao')->nullable();

            // Concordância com a LGPD
            $table->boolean('concordancia_lgpd')->default(false);

            // Caminho do PDF gerado automaticamente
            $table->string('pdf_path')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
};
