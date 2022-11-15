<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralComment extends Model
{
    use HasFactory;
    protected $table = "general_comment";
    protected $guarded = ['id'];

    public function restaurent(){
        return $this->belongsTo(Restaurent::class,'restaurent_id','id');
    }
}
