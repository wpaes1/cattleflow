<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'id_farm', 'picket_description', 'width', 'depth'])]
class Picket extends Model
{
    //
    public $timestamps = false;
}
