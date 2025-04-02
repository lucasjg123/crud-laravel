<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $fillable = ['id', 'title', 'description', 'due_date', 'status'];
}
