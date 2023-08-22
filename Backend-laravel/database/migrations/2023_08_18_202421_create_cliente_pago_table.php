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
        Schema::create('cliente_pago', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pago_id");
            $table->foreign("pago_id")->references("id")->on("pagos")->onDelete("cascade");

            $table->unsignedBigInteger("cliente_id");
            $table->foreign("cliente_id")->references("id")->on("clientes")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_pago');
    }
};
