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
            $table->string('stock_lot')->nullable();
            $table->date('validity')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('purpose')->nullable();
            $table->string('dosage')->nullable();
            $table->string('interval_days')->nullable();
            $table->string('application_method')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('path_tax_document')->nullable();
            $table->string('path_prescription')->nullable();
            $table->string('professional_name')->nullable();
            $table->string('professional_register_number')->nullable();
            $table->string('status', 1)->default('A'); //active, inactive
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
