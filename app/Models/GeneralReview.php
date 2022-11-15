<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralReview extends Model
{
    use HasFactory;
    protected $table = "general_review";
    protected $guarded = ['id'];
}
