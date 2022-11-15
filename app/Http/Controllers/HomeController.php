<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurent;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function loggedHome()
    {
        if(Auth::user()->role==1){
            $data = Restaurent::with('general')->get();
            return view('home',compact('data'));
        }else{
            return view('admin.pages.index');
        }
        
    }

    public function index()
    {
        $data = Restaurent::with('general')->get();
        return view('home',compact('data'));
    }
}
