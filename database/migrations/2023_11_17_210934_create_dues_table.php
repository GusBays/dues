<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dues', function (Blueprint $table) {
            $table->id();
            $table->string('declarante_cpf_cnpj')->nullable(false);
            $table->string('declarante_razao_social')->nullable(false);
            $table->string('identificacao')->nullable(false);
            $table->string('numero')->nullable(false);
            $table->integer('moeda')->nullable(false);
            $table->string('incoterm')->nullable(false);
            $table->longText('informacoes_complementares')->nullable();
            $table->decimal('total_vmle_moeda', 17, 2)->nullable();
            $table->decimal('total_vmcv_moeda', 17, 2)->nullable();
            $table->decimal('total_peso_liquido', 17, 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dues');
    }
};
