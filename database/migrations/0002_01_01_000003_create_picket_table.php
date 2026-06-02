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
        Schema::create('pickets', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('id_farm')->index();

            $table->foreignId('id_farm')
                    ->references('id')
                    ->on('farms')
                    ->onDelete('cascade');


            $table->string('picket_description');
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('depth', 10, 2)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickets');
    }
};
