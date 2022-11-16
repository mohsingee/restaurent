<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $data = Restaurent::with('foods','occasion','general')->get();
            return view('frontend.pages.home',compact('data'));
        }else{
            return view('admin.pages.index');
        }
    }

    public function index()
    {
        $data = Restaurent::with('foods','occasion','general')->get();
        return view('frontend.pages.home',compact('data'));
    }

    public function showReview($id){
        $restaurent = Restaurent::whereId($id)->with('services','foods','occasion','meals','general','comment')->first();
        return view('frontend.pages.reviewDetail',compact('restaurent'));
    }

    public function advanceSearch(Request $request){
        if($request->search_food !='' && $request->search_occasion !='' && $request->search_cost !='' && $request->ratingWise !=''){
            
            $food = $request->search_food;
            $occasion = $request->search_occasion;
            $cost = $request->search_cost;
            $rating = $request->ratingWise;
            if($rating==1){ $rate = 'desc'; }else{ $rate = 'asc'; }

            $restaurents = Restaurent::where('min','<=', $cost)->where('max', '>=', $cost)->whereHas('foods', function($q) use ($food){
                $q->where('name', 'Like', '%' . $food . '%');
            })->whereHas('occasion', function($q) use ($occasion){
                $q->where('name', 'Like', '%' . $occasion . '%');
            })->whereHas('general', function($q) use ($rate){
                $q->orderBy('overallRating',$rate);
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_food !='' && $request->search_occasion !='' && $request->search_cost !=''){
            
            $food = $request->search_food;
            $occasion = $request->search_occasion;
            $cost = $request->search_cost;
            $restaurents = Restaurent::where('min','<=', $cost)->where('max', '>=', $cost)->whereHas('foods', function($q) use ($food){
                $q->where('name', 'Like', '%' . $food . '%');
            })->whereHas('occasion', function($q) use ($occasion){
                $q->where('name', 'Like', '%' . $occasion . '%');
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_food !='' && $request->search_occasion !='' && $request->ratingWise !=''){
            
            $food = $request->search_food;
            $occasion = $request->search_occasion;
            $rating = $request->ratingWise;
            if($rating==1){ $rate = 'desc'; }else{ $rate = 'asc'; }

            $restaurents = Restaurent::whereHas('foods', function($q) use ($food){
                $q->where('name', 'Like', '%' . $food . '%');
            })->whereHas('occasion', function($q) use ($occasion){
                $q->where('name', 'Like', '%' . $occasion . '%');
            })->whereHas('general', function($q) use ($rate){
                $q->orderBy('overallRating',$rate);
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_food !='' && $request->search_cost !='' && $request->ratingWise !=''){
            
            $food = $request->search_food;
            $cost = $request->search_cost;
            $rating = $request->ratingWise;
            if($rating==1){ $rate = 'desc'; }else{ $rate = 'asc'; }

            $restaurents = Restaurent::where('min','<=', $cost)->where('max', '>=', $cost)->whereHas('foods', function($q) use ($food){
                $q->where('name', 'Like', '%' . $food . '%');
            })->whereHas('general', function($q) use ($rate){
                $q->orderBy('overallRating',$rate);
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_occasion !='' && $request->search_cost !='' && $request->ratingWise !=''){
        
            $occasion = $request->search_occasion;
            $cost = $request->search_cost;
            $rating = $request->ratingWise;
            if($rating==1){ $rate = 'desc'; }else{ $rate = 'asc'; }

            $restaurents = Restaurent::where('min','<=', $cost)->where('max', '>=', $cost)->whereHas('occasion', function($q) use ($occasion){
                $q->where('name', 'Like', '%' . $occasion . '%');
            })->whereHas('general', function($q) use ($rate){
                $q->orderBy('overallRating',$rate);
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_food !='' && $request->search_occasion !=''){
            
            $food = $request->search_food;
            $occasion = $request->search_occasion;

            $restaurents = Restaurent::whereHas('foods', function($q) use ($food){
                $q->where('name', 'Like', '%' . $food . '%');
            })->whereHas('occasion', function($q) use ($occasion){
                $q->where('name', 'Like', '%' . $occasion . '%');
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_food !='' && $request->search_cost !=''){
            
            $food = $request->search_food;
           
            $cost = $request->search_cost;
            
            $restaurents = Restaurent::where('min','<=', $cost)->where('max', '>=', $cost)->whereHas('foods', function($q) use ($food){
                $q->where('name', 'Like', '%' . $food . '%');
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_food !='' && $request->ratingWise !=''){
            
            $food = $request->search_food;
            $rating = $request->ratingWise;
            if($rating==1){ $rate = 'desc'; }else{ $rate = 'asc'; }

            $restaurents = Restaurent::whereHas('foods', function($q) use ($food){
                $q->where('name', 'Like', '%' . $food . '%');
            })->whereHas('general', function($q) use ($rate){
                $q->orderBy('overallRating',$rate);
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_occasion !='' && $request->search_cost !=''){
            
            $occasion = $request->search_occasion;
            $cost = $request->search_cost;

            $restaurents = Restaurent::where('min','<=', $cost)->where('max', '>=', $cost)->whereHas('occasion', function($q) use ($occasion){
                $q->where('name', 'Like', '%' . $occasion . '%');
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_occasion !='' && $request->ratingWise !=''){
            
            $occasion = $request->search_occasion;
            $rating = $request->ratingWise;
            if($rating==1){ $rate = 'desc'; }else{ $rate = 'asc'; }

            $restaurents = Restaurent::whereHas('occasion', function($q) use ($occasion){
                $q->where('name', 'Like', '%' . $occasion . '%');
            })->whereHas('general', function($q) use ($rate){
                $q->orderBy('overallRating',$rate);
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_cost !='' && $request->ratingWise !=''){
        
            $cost = $request->search_cost;
            $rating = $request->ratingWise;
            if($rating==1){ $rate = 'desc'; }else{ $rate = 'asc'; }

            $restaurents = Restaurent::where('min','<=', $cost)->where('max', '>=', $cost)->whereHas('general', function($q) use ($rate){
                $q->orderBy('overallRating',$rate);
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        if($request->search_food){
            $food = $request->search_food;
            $restaurents = Restaurent::whereHas('foods', function($q) use ($food){
                $q->where('name', 'Like', '%' . $food . '%');
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }

        if($request->search_occasion){
            $occasion = $request->search_occasion;
            $restaurents = Restaurent::whereHas('occasion', function($q) use ($occasion){
                $q->where('name', 'Like', '%' . $occasion . '%');
            })->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }

        if($request->search_cost){
            $cost = $request->search_cost;
            $restaurents = Restaurent::where('min','<=', $cost)->where('max', '>=', $cost)->get();
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }

        if($request->ratingWise){
            $rating = $request->ratingWise;
            if($rating==1){
                $restaurents = Restaurent::whereHas('general', function($q){
                    $q->orderBy('overallRating','desc');
                })->get();
            }else{
                $restaurents = Restaurent::whereHas('general', function($q){
                    $q->orderBy('overallRating','asc');
                })->get();
            }
            return view('frontend.pages.searchRecords',compact('restaurents'));
        }
        return redirect()->back()->with('error','you have not entered any keyword');
    }

    public function searchRestaurents(Request $request)
    {
        $searcRestaurents = [];
        if($request->has('q')){
            $search = $request->q;
            $searcRestaurents = Restaurent::where('location', 'LIKE', "%$search%")->get();
        }
        return response()->json($searcRestaurents);
    }

    public function getRestaurents(Request $request){
        $data = Restaurent::where('id',$request->id)->get();
        $html = '';
        $html .= view('frontend.pages.ajax_load.search_restaurents', compact('data'));
        $msg = "About ".count($data)." results found";
        return response()->json(array(
            'data' => $html,
            'msg' => $msg,
        ));
    }
}
