<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'Tags';

    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'content'
    ];
}
