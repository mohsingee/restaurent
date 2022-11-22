<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.pages.index');
    }

    public function usersList(){
        $users = User::where('role','!=',0)->get();
        return view('admin.pages.users',compact('users'));
    }

    public function userDelete($id){
        User::destroy($id);
        return redirect()->back()->with('success','User successfully deleted.');
    }
}
