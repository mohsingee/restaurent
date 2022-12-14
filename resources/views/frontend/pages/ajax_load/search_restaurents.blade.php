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