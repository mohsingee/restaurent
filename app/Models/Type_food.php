<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_food extends Model
{
    use HasFactory;
    protected $table = 'type_foods';
    protected $guarded = ['id'];
}
