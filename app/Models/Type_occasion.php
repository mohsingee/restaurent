<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_occasion extends Model
{
    use HasFactory;
    protected $table = 'type_occasions';
    protected $guarded = ['id'];
}
