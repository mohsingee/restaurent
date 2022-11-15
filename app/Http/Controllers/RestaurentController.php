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
use App\Models\General_restaurent_experiance;
class RestaurentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Restaurent::all();
        return view('admin.pages.view_restaurent',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.add_restaurent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = $request->file;
        $fileName = time() . '-' . $img->getClientOriginalName();
        $img->move(public_path('restaurents/'),$fileName);

        $store = Restaurent::create([
            'name' => $request->name,
            'location' => $request->location,
            'file' => $fileName,
            'min' => $request->min,
            'max' => $request->max,
        ]);
        $this->insertServices($request->type_services,$store->id);
        $this->insertFoods($request->type_foods,$store->id);
        $this->insertOccasion($request->type_occasion,$store->id);
        $this->insertMeals($request->type_meals,$store->id);
        $data = array("expenseRating", "foodRating", "ambianceRating","serviceRating","cleanlinessRating","speedRating","valueRating","allergyRating","overallRating");
        foreach($data as $item)
        {
            General_restaurent_experiance::create([
                'name' => $item,
                'restaurent_id' => $store->id,
            ]);
        }
        return redirect()->back()->with('success','Restaurent created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Restaurent::whereId($id)->with('services','foods','occasion','meals')->first();
        return view('admin.pages.edit_restaurent',compact('data'));
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
        if(isset($request->file)){
            $fileName = time() . '-' . $request->file->getClientOriginalName();
            $request->file->move(public_path('restaurents/'), $fileName);
        }
        else{
            $data = Restaurent::where('id',$id)->first();
            $fileName = $data->file;
        }
        Restaurent::whereId($id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'file' => $fileName,
            'min' => $request->min,
            'max' => $request->max,
        ]);
        Type_service::where('restaurent_id',$id)->delete();
        Type_food::where('restaurent_id',$id)->delete();
        Type_occasion::where('restaurent_id',$id)->delete();
        Type_meal::where('restaurent_id',$id)->delete();
        $this->insertServices($request->type_services,$id);
        $this->insertFoods($request->type_foods,$id);
        $this->insertOccasion($request->type_occasion,$id);
        $this->insertMeals($request->type_meals,$id);
        return redirect()->route('restaurent.index')->with('success','You have successfully update the restaurent records');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Restaurent::destroy($id);
        return redirect()->back()->with('success','Restaurent successfully deleted.');
    }

    public function insertServices($records,$id){
        if($records)
        {
            foreach($records as $data)
            {
                if($data != ""){
                    Type_service::create([
                        'name' => $data,
                        'restaurent_id' => $id,
                    ]);
                }
            }
        }
        return true;
    }

    public function insertFoods($records,$id){
        if($records)
        {
            foreach($records as $data)
            {
                if($data != ""){
                    Type_food::create([
                        'name' => $data,
                        'restaurent_id' => $id,
                    ]);
                }
            }
        }
        return true;
    }

    public function insertOccasion($records,$id){
        if($records)
        {
            foreach($records as $data)
            {
                if($data != ""){
                    Type_occasion::create([
                        'name' => $data,
                        'restaurent_id' => $id,
                    ]);
                }
            }
        }
        return true;
    }

    public function insertMeals($records,$id){
        if($records)
        {
            foreach($records as $data)
            {
                if($data != ""){
                    Type_meal::create([
                        'name' => $data,
                        'restaurent_id' => $id,
                    ]);
                }
            }
        }
        return true;
    }
}
