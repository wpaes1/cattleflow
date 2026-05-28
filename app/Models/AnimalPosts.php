<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'id_animal', 'post_description', 'post_date'])]
class AnimalPosts extends Model
{
    //
      protected $table = 'animal_posts';
    public $timestamps = false;
}
