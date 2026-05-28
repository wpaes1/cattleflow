<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'trade_name', 'stock_lot', 'validity', 'purchase_date', 'manufacturer', 'purpose', 'dosage', 'interval_days', 'application_method', 'supplier_name', 'path_tax_document', 'path_prescription', 'professional_name', 'professional_register_number'])]
class VaccineAnimals extends Model
{
    //
    protected $table = 'vaccine_animals';
    public $timestamps = false;
}
