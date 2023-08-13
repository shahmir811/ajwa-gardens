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
        Schema::table('allotments', function (Blueprint $table) {
            $table->string('down_payment_mode')->nullable();            
            $table->string('down_payment_receipt_no')->nullable();
            $table->string('down_payment_bank_receipt_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('allotments', function (Blueprint $table) {
            $table->dropColumn('down_payment_mode');
            $table->dropColumn('down_payment_receipt_no');
            $table->dropColumn('down_payment_bank_receipt_no');
        });
    }
};
