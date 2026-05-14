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
             $table->foreignId('id_lot_animal')->nullable()->index();
            $table->string('earring_number');
            $table->string('sex');
            $table->string('age');
            $table->integer('entry_weight');
            $table->string('breed');
            $table->string('sisbov_mapa_br');

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
