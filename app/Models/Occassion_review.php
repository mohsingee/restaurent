<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occassion_review extends Model
{
    use HasFactory;
    protected $table = 'occasion_reviews';
    protected $guarded = ['id'];
}
