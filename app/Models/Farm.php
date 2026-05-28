<?php

namespace App\Models;

use Database\Factories\FarmFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'farm_name', 'registration_number', 'owner_name', 'location', 'city', 'state_registration', 'country', 'total_area'])]
class Farm extends Model
{
    //
     public $timestamps = false;
}
