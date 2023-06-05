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
        Schema::create('payment_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('monthly_amount');
            $table->integer('amount_received')->default(0);
            $table->date('amount_received_on')->nullable();
            $table->integer('three_or_six_month');
            $table->integer('remaining_amount');
            $table->foreignId('allotment_id');

            $table->foreign('allotment_id')->references('id')->on('allotments')->onDelete('cascade');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_schedules');
    }
};
