<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'id_user', 'code_number', 'verified', 'expiration_at'])]
class UserActivation extends Model
{
    //
    protected $table = 'user_activations';
}
