<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services_review extends Model
{
    use HasFactory;
    protected $table = 'services_reviews';
    protected $guarded = ['id'];
}
