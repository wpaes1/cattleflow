<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'id_user', 'hability'])]
class UserProfileHability extends Model
{
    //
    protected $table = 'user_profile_habilitys';

}
