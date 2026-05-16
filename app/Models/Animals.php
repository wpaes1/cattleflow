<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'id_lot_animal', 'earring_number', 'age', 'sex', 'entry_weight', 'breed', 'sisbov_mapa_br', 'status'])]
class Animals extends Model
{
    //
        public $timestamps = false;
}
