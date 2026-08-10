<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'category', 'image', 'problem', 'solution', 'result', 'metrics_1_val', 'metrics_1_label', 'metrics_2_val', 'metrics_2_label', 'featured'];
}
