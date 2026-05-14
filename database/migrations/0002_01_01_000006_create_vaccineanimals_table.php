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
        Schema::create('vaccine_animals', function (Blueprint $table) {
            $table->id();
            $table->string('trade_name');
            $table->string('stock_lot');
            $table->date('validity');
            $table->date('purchase_date');
            $table->string('manufacturer');
            $table->string('purpose');
            $table->string('dosage');
            $table->string('interval_days');
            $table->string('application_method');
            $table->string('suplier_name');
            $table->string('tax_document');
            $table->string('prescription');
            $table->string('professional_name');
            $table->string('professional_number');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_animals');
    }
};
