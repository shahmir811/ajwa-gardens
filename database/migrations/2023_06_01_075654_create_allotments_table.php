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
        Schema::create('allotments', function (Blueprint $table) {
            $table->id();
            $table->integer('total_amount');
            $table->integer('down_amount');
            $table->integer('monthly_amount');
            $table->integer('per_marla_rate');
            $table->integer('three_months_amount');
            $table->integer('six_months_amount');
            $table->integer('total_months');
            $table->date('starting_date');
            $table->string('registration_no')->unique();
            $table->string('form_no')->unique();
            $table->foreignId('phase_id');
            $table->foreignId('customer_id');
            $table->foreignId('plot_id');

            $table->foreign('phase_id')->references('id')->on('phases')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('plot_id')->references('id')->on('plots')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allotments');
    }
};
