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
        Schema::table('payment_schedules', function (Blueprint $table) {
            $table->string('payment_mode')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('bank_receipt_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_schedules', function (Blueprint $table) {
            $table->dropColumn('payment_mode');
            $table->dropColumn('receipt_no');
            $table->dropColumn('bank_receipt_no');
        });
    }
};
