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
            //$table->foreignId('id_picket')->index();


            $table->foreignId('id_picket')
                    ->references('id')
                    ->on('pickets')
                    ->onDelete('cascade');



            $table->integer('lot_number');
            $table->string('lot_description')->nullable();
            $table->string('origin')->nullable();
            $table->date('entry_date')->nullable();
            $table->integer('quantity_animals')->nullable();
            $table->decimal('average_weight', 10, 2)->nullable();
            $table->string('destination')->nullable();
            $table->date('exit_date')->nullable();
            $table->string('status', 1)->default('A');  //comment('A - Aberto, T - Transferido, D - Desmembrado, G - Agrupado, F - Fechado');

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
