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
        Schema::create('due_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('due_id')->nullable();
            $table->integer('item')->nullable(false);
            $table->string('nfe_chave')->nullable(false);
            $table->string('nfe_numero')->nullable(false);
            $table->string('nfe_serie')->nullable(false);
            $table->integer('nfe_item')->nullable(false);
            $table->longText('descricao_complementar')->nullable(false);
            $table->string('ncm')->nullable(false);
            $table->decimal('vmle_moeda', 17, 2)->nullable();
            $table->decimal('vmcv_moeda', 17, 2)->nullable();
            $table->decimal('peso_liquido', 17, 5)->nullable();
            $table->string('enquadramento1')->nullable();
            $table->string('enquadramento2')->nullable();
            $table->string('enquadramento3')->nullable();
            $table->string('enquadramento4')->nullable();
            $table->timestamps();

            $table->foreign('due_id')
                ->references('id')
                ->on('dues')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('due_itens');
    }
};
