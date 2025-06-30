<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcionario_id')->constrained()->onDelete('cascade');
            $table->string('nome_completo');
            $table->string('cpf', 14);
            $table->date('data_nascimento');
            $table->enum('tipo_dependencia', ['filho', 'conjuge', 'pai', 'mae', 'outros']);
            $table->boolean('dependente_ir')->default(false)->after('outros_dependencia');
            $table->boolean('dependente_salario_familia')->default(false)->after('dependente_ir');
            $table->boolean('dependente_plano_saude')->default(false)->after('dependente_salario_familia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dependentes');
    }
};
