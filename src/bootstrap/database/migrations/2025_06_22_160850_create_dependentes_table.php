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
            $table->string('cpf', 14)->nullable();
            $table->date('data_nascimento');
            $table->enum('tipo_dependencia', ['filho', 'conjuge', 'pai', 'mae', 'outros']);
            $table->string('outros_dependencia')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dependentes');
    }
};
