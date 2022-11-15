<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals_review extends Model
{
    use HasFactory;
    protected $table = 'meals_reviews';
    protected $guarded = ['id'];
}
