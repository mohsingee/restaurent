<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurent;
use App\Models\Type_service;
use App\Models\Type_meal;
use App\Models\Type_food;
use App\Models\Type_occasion;
use App\Models\Services_review;
use App\Models\Foods_review;
use App\Models\Occassion_review;
use App\Models\Meals_review;
use App\Models\GeneralReview;
use App\Models\GeneralComment;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ///--- For Services ---///
        $services = Type_service::all();
        foreach($services as $ser){
            if(isset($_POST['ser'.$ser->id])){
                Services_review::create([
                    'user_id' => Auth::user()->id,
                    'service_id' => $ser->id,
                    'review' => $_POST['ser'.$ser->id],
                ]);
                $count = Services_review::where('service_id',$ser->id)->avg('review');
                Type_service::where('id',$ser->id)->update(['review_count'=>round($count)]);
            }
        }

        ///--- For Foods ---///
        $foods = Type_food::all();
        foreach($foods as $food){
            if(isset($_POST['food'.$food->id])){
                Foods_review::create([
                    'user_id' => Auth::user()->id,
                    'food_id' => $food->id,
                    'review' => $_POST['food'.$food->id],
                ]);
                $count = Foods_review::where('food_id',$food->id)->avg('review');
                Type_food::where('id',$food->id)->update(['review_count'=>round($count)]);
            }
        }

        ///--- For Occasion ---///
        $occasions = Type_occasion::all();
        foreach($occasions as $occ){
            if(isset($_POST['occasion'.$occ->id])){
                Occassion_review::create([
                    'user_id' => Auth::user()->id,
                    'occasion_id' => $occ->id,
                    'review' => $_POST['occasion'.$occ->id],
                ]);
                $count = Occassion_review::where('occasion_id',$occ->id)->avg('review');
                Type_occasion::where('id',$occ->id)->update(['review_count'=>round($count)]);
            }
        }

        ///--- For Meals ---///
        $meals = Type_meal::all();
        foreach($meals as $meal){
            if(isset($_POST['meal'.$meal->id])){
                Meals_review::create([
                    'user_id' => Auth::user()->id,
                    'meals_id' => $meal->id,
                    'review' => $_POST['meal'.$meal->id],
                ]);
                $count = Meals_review::where('meals_id',$meal->id)->avg('review');
                Type_meal::where('id',$meal->id)->update(['review_count'=>round($count)]);
            }
        }

        if(isset($request->expenseRating)){
            $get = General_restaurent_experiance::where('name','expenseRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->expenseRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->foodRating)){
            $get = General_restaurent_experiance::where('name','foodRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->foodRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->ambianceRating)){
            $get = General_restaurent_experiance::where('name','ambianceRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->ambianceRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->serviceRating)){
            $get = General_restaurent_experiance::where('name','serviceRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->serviceRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->cleanlinessRating)){
            $get = General_restaurent_experiance::where('name','cleanlinessRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->cleanlinessRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->speedRating)){
            $get = General_restaurent_experiance::where('name','speedRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->speedRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->valueRating)){
            $get = General_restaurent_experiance::where('name','valueRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->valueRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->allergyRating)){
            $get = General_restaurent_experiance::where('name','allergyRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->allergyRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->overallRating)){
            $get = General_restaurent_experiance::where('name','overallRating')->first();
            GeneralReview::create([
                'user_id' => Auth::user()->id,
                'general_restaurent_id' => $get->id,
                'review' => $request->overallRating,
            ]);
            $count = GeneralReview::where('general_restaurent_id',$get->id)->avg('review');
            General_restaurent_experiance::where('id',$get->id)->update(['review_count'=>round($count)]);
        }
        if(isset($request->comment)){
            GeneralComment::create([
                'user_id' => Auth::user()->id,
                'restaurent_id' => $request->restaurent_id,
                'comment' => $request->comment,
            ]);
        }

        return redirect('home')->with('success','You have successfully submit your review');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurent = Restaurent::whereId($id)->with('services','foods','occasion','meals','general','comment')->first();
        return view('frontend.pages.reviewDetail',compact('restaurent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = GeneralComment::whereId($id)->with('restaurent')->first();
        return view('frontend.pages.editReview',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        GeneralComment::where('id',$id)->update([
            'comment' => $request->comment,
        ]);
        return redirect('my-reviews')->with('success','You Review has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addReview($id){
        $restaurent = Restaurent::whereId($id)->with('services','foods','occasion','meals','general')->first();
        return view('frontend.pages.addReview',compact('restaurent'));
    }

    public function myReviews(){
        $data = GeneralComment::where('user_id',Auth::user()->id)->with('restaurent')->get();
        return view('frontend.pages.myReview',compact('data'));
    }
}
