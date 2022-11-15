<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_service extends Model
{
    use HasFactory;
    protected $table = 'type_services';
    protected $guarded = ['id'];
}
