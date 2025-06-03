<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /// database/migrations/xxxx_xx_xx_xxxxxx_add_diamond_id_to_transactions_table.php
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('diamond_id')->nullable()->after('user_id')->constrained('diamonds')->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['diamond_id']);
            $table->dropColumn('diamond_id');
        });
    }
};
