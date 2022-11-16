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
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="message alert_margin">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @forelse($data as $item)
            <div class="box-part">
                <div class="img-content">
                <div class="img">
                    <img src="{{ asset('restaurents/'.$item->restaurent->file)}}" width="260" alt="">
                </div>
                <div class="content-info">
                @foreach($item->restaurent->general as $row)
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
                    <h4>{{ $item->restaurent->name }}</h4>
                </div>
                @if($item->comment)
                <hr>
                <div class="">
                    <div class="rat-content">
                        <form action="{{ route('review.destroy',$item->id) }}" method="post">
                            <button class="cancel text-right" type="submit">Delete</button>
                            @method('delete')
                            @csrf
                        </form>
                        <form action="{{ route('review.edit',$item->id) }}" method="get">
                            <button class="cancel text-right" type="submit">Edit</button>
                        </form>
                        <div class="rating-card">
                            <div class="card-title"><b>{{ Auth::user()->first_name.' '.Auth::user()->last_name}}</b></div>
                        </div>
                        <div class="content-info">
                            <div class="rating">
                               {{ $item->comment }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @empty
            <div class="box-part">
                <div class="content-info">
                    No records found
                </div>
            </div>
            @endforelse
        </div>	 
    </div>
</div>
@endsection
