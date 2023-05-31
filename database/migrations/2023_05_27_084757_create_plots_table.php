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
        Schema::create('plots', function (Blueprint $table) {
            $table->id();
            $table->string('plot_no')->unique();
            $table->double('marla', 8, 3);
            $table->enum('type', ['residential', 'commercial']);
            $table->boolean('available')->default(true); 
            // $table->string('registration_no')->unique();
            // $table->string('form_no')->unique();
            $table->boolean('corner_plot')->default(false);
            $table->boolean('facing_park')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plots');
    }
};
