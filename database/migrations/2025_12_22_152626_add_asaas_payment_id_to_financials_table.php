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
        Schema::table('financials', function (Blueprint $table) {
             $table->string('asaas_payment_id', 100)
                ->nullable()
                ->after('id'); // ajuste se quiser outra posição

            // índice para performance e evitar duplicações futuras
            $table->index('asaas_payment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financials', function (Blueprint $table) {
            $table->dropIndex(['asaas_payment_id']);
            $table->dropColumn('asaas_payment_id');
        });
    }
};
