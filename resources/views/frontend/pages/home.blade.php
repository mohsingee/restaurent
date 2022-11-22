@extends('frontend.layouts.app')
@section('content')
<style>
    body{
    background: #eee;
}
span{
    font-size:15px;
}
.box{
    padding:60px 0px;
}

.box-part{
    background:#FFF;
    border-radius:0;
    padding:10px 20px;
    margin:30px 0px;
}
.text{
    margin:20px 0px;
}

.fa{
     color:#4183D7;
}
.img-content{
    display: flex;
    justify-content: space-between;
    width: 100%;
}
.content-info{
    width: 50%;
}
.img{
    width: 50%;
}
.rating{
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}
.text-right{
    float:right;
}

.cancel{
    padding: 5px 25px;
    border: 1px solid rgb(71, 194, 194);
    border-radius: 50px;
    transition: 0.5s all;
    font-weight: bold;
}

.cancel-btn{
    padding: 5px 25px;
    border: 1px solid rgb(71, 194, 194);
    border-radius: 50px;
    transition: 0.5s all;
    font-weight: bold;
}
.cancel-btn:hover{
    background-color: #000;
    color: #FFF;
}
#overlay {
    background:rgba(0,0,0,0.8);
    color: #fff;
    position: fixed;
    height: 100%;
    width: 100%;
    z-index: 5000;
    top: 0;
    left: 0;
    float: left;
    text-align: center;
    padding-top: 20%;
    filter: blur(1px);
}

/* search bar code */
.select2-selection__arrow{
    display: none
}

.input-group .btn {
    /* position: relative; */
    /* z-index: 2; */
    position: ABSOLUTE;
    RIGHT: 0;
    TOP: 0;
    background: #000;
    padding: 0px;
    width: 40px;
    color: #fff;
    height: 100%;
    border-radius: 2px;
    z-index: 1;
}
.select2-container--classic .select2-selection--single{

    height: 38px;
}
.select2-container--classic .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 38px;
}

.select2-container--classic .select2-search--dropdown .select2-search__field {
    border: 1px solid #aaa;
    outline: 0;
    position: absolute;
    top: -37px;
    width: 88%;
    padding-top: 8px;
}
.select2-container--classic .select2-results__option--highlighted.select2-results__option--selectable {
    background-color: #fff;
    color: #000;
}
/* End search bar code */
</style>
<div id="overlay" style="display: none">
    <img src="{{asset('img/loader1.gif')}}" alt="Loading" /><br/>
 </div>
<div class="container">
    <div class="row justify-content-center">
        @if(count($data)>0)
        <div class="col-md-4">
            <section class="search_div mm_top_serach">
                <div class="top_bottom_search">
                   <div class="input-group justify-content-center">
                      <select class="livesearch proSearch form-control form-select srac_inp" id="search" name="productSearch" placeholder="Type to search products"></select>
                      <div class="input-group-append">
                         <button class="btn srac_btn" type="button">
                         <i class="fa fa-search"></i>
                         </button>
                      </div>
                   </div>
                </div>
             </section>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Advance Search
              </button>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Advance search</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('advance.search') }}" method="post">
                @csrf
                    <div class="row modal-body">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" name="search_food" class="form-control" placeholder="Search by type of cuisine">
                            </div>
                        </div>
                        <div class="mt-4 col-md-12">
                            <div class="input-group">
                                <input type="text" name="search_occasion" class="form-control" placeholder="Search by type of occasion">
                            </div>
                        </div>
                        <div class="mt-4 col-md-12">
                            <div class="input-group">
                                <input type="number" min="1" name="search_cost" class="form-control" placeholder="Search by cost">
                            </div>
                        </div>
                        <div class="mt-4 col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ratingWise" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Sort by High Rating</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ratingWise" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">Sort by Low Rating</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
        @else
        <div class="box-part">
            <div class="content-info">
                <div class="content-details">
                    No restaurents founds.
                </div>
            </div>
        </div>
        @endif
        <div id="ajaxSearchmsg"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ajaxRestaurents">
            <div class="message alert_margin">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            @foreach($data as $item)
                <div class="box-part">
                    <div class="img-content">
                    <div class="img">
                        <img src="{{ asset('restaurents/'.$item->file)}}" width="260" alt="">
                    </div>
                    <div class="content-info">
                    @foreach($item->general as $row)
                    <div class="rating">
                        <div class="content-details">
                            {{ $row->name }} 
                        </div>
                        <div class="content-rating">
                            @for($i=1; $i<=5;  $i++ )
                                @if($i<=$row->review_count)
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    @endforeach
                    </div>
                    </div>
                    <div class="title">
                        <h4>{{ $item->name }}</h4>
                        <p><b>Location: </b>{{ $item->location }}</p>
                    </div>
                    <button class="cancel text-right mb-4"><a href="{{ route('show.review',$item->id) }}">View Detail</a></button>
                    <br><br>
                    @auth
                    <div class="text">
                        <span>Have you tried <b>A & K</b> yet? Add your review to help other find the perfect restaurent</span>
                        <button class="cancel text-right">
                            @if(checkFeedback()>0)
                                <a href="{{ route('my_reviews') }}">My Reviews</a>
                            @else
                                <a href="{{ route('add.review',$item->id) }}">Add your review</a>
                            @endif
                        </button>
                    </div> 
                    @endauth
                </div>
            @endforeach
        </div>	 
    </div>
</div>
@endsection
