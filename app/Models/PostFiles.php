<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'id_post', 'path', 'type'])]
class PostFiles extends Model
{
    //
    protected $table = 'post_files';
    public $timestamps = false;
}
