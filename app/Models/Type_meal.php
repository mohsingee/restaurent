<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_meal extends Model
{
    use HasFactory;
    protected $table = 'type_meals';
    protected $guarded = ['id'];
}
