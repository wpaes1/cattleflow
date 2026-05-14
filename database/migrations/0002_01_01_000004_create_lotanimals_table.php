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
        Schema::create('lot_animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_picket')->index();
            $table->string('lot_number');
            $table->string('lot_description')->nullable();
            $table->string('origin')->nullable();
            $table->integer('entry_date');
            $table->integer('quantity_animals');
            $table->decimal('average_weight', 10, 2)->nullable();
            $table->string('destination')->nullable();
            $table->integer('exit_date')->nullable();
            $table->string('status')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lot_animals');
    }
};
