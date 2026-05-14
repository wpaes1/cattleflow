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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_lot_animal')->index();
            $table->string('earring_number')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->integer('entry_weight')->nullable();
            $table->string('breed')->nullable();
            $table->string('sisbov_mapa_br')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
