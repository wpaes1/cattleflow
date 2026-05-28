<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'id_picket', 'lot_number', 'lot_description', 'origin', 'entry_date', 'quantity_animals', 'average_weight', 'destination', 'exit_date', 'status'])]
class LotAnimals extends Model
{
    //
    protected $table = 'lot_animals';
    public $timestamps = false;

}
