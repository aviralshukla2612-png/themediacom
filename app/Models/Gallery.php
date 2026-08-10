<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false;
    protected $table = 'gallery';
    protected $fillable = ['image', 'category', 'sort_order'];
}
