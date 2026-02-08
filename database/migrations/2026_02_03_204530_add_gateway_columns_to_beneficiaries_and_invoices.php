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
        // 1. Adiciona a coluna na tabela de beneficiários
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->string('payment_gateway')->default('asaas')->after('asaas_customer_id');
        });

        // 2. Adiciona a coluna na tabela de invoices
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('payment_gateway')->default('asaas')->after('asaas_payment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->dropColumn('payment_gateway');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('payment_gateway');
        });
    }
};
