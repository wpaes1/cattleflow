<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'id_user', 'bio', 'phone', 'avatar', 'date_of_birth', 'gender', 'address', 'city', 'state', 'postal_code', 'country'])]
class UserProfile extends Model
{
    //
    protected $table = 'user_profiles';
}
