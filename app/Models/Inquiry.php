<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    public $timestamps = false;
    protected $fillable = ['form_type', 'name', 'email', 'phone', 'company', 'service_type', 'budget_range', 'message', 'extra_data', 'status'];
}
