<?php

use App\Models\User;
use App\Models\Restaurent;
use App\Models\Type_service;
use App\Models\GeneralReview;

function userCount(){
    return User::where('role','!=',0)->count();
}

function restaurentCount(){
    return Restaurent::count();
}

function userInfo($id){
    return User::where('id',$id)->first();
}

function checkFeedback(){
    return GeneralReview::where('user_id',Auth::user()->id)->count();
}

