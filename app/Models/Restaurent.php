<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurent extends Model
{
    use HasFactory;
    protected $table = 'restaurants';
    protected $guarded = ['id'];


    public function services()
    {
        return $this->hasMany(Type_service::class,'restaurent_id','id');
    }
    public function foods()
    {
        return $this->hasMany(Type_food::class,'restaurent_id','id');
    }
    public function meals()
    {
        return $this->hasMany(Type_meal::class,'restaurent_id','id');
    }
    public function occasion()
    {
        return $this->hasMany(Type_occasion::class,'restaurent_id','id');
    }
    public function general()
    {
        return $this->hasMany(General_restaurent_experiance::class,'restaurent_id','id');
    }
    public function comment()
    {
        return $this->hasMany(GeneralComment::class,'restaurent_id','id');
    }
}
