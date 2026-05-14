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
        Schema::create('lotanimals_vaccines', function (Blueprint $table) {
           $table->foreignId('id_lot_animal')->nullable()->index();
           $table->foreignId('id_vaccine_animal')->nullable()->index(); 
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotanimals_vaccines');
    }
};
