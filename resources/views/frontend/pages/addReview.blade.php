@extends('frontend.layouts.app') 
@section('content')
<style>
body {
	background: #eee;
}

span {
	font-size: 15px;
}

.box {
	padding: 60px 0px;
}

.box-part {
	background: #FFF;
	border-radius: 0;
	padding: 10px 10px;
	margin: 30px 0px;
}

.text {
	margin: 20px 0px;
}

.fa {
	color: #4183D7;
}

/* Header start */

.rating-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding-bottom: 20px;
}

.rat-content {
	width: 100%;
	border: 1px solid rgb(219, 214, 214);
	border-radius: 10px;
	margin-bottom: 10px;
	padding: 10px;
	background: #FFF;
}

.content-info {
	width: 50%;
}

.content-info {
	width: 50%;
}

.rating {
	display: flex;
	justify-content: space-between;
	margin-bottom: 5px;
	height: 28px;
	align-items: center;
}

.rating-card {
	margin-bottom: 15px;
}

.card-title {
	font-size: 16px;
	font-weight: 700;
	color: #000;
}

.content-details {
	color: #000;
	font-weight: bold;
	font-size: 12px;
}

.header-title {
	font-size: 22px;
	font-weight: bold;
	color: #000;
}

.resut-rating {
	display: flex;
	align-items: center;
	border: 1px solid rgb(76, 72, 72);
	border-radius: 50px;
	padding: 5px 15px;
}

.circle {
	width: 50px;
	height: 50px;
	background-color: rgb(71, 194, 194);
	border-radius: 50%;
	margin-right: 5px;
}

.circle-title {
	font-size: 16px;
	color: #000;
	font-weight: 600;
}

.cancel-btn {
	padding: 5px 25px;
	border: 1px solid rgb(71, 194, 194);
	border-radius: 50px;
	transition: 0.5s all;
	font-weight: bold;
}

.cancel-btn:hover {
	background-color: #000;
	color: #FFF;
}

.submit {
	padding: 5px 25px;
	border: 1px solid rgb(71, 194, 194);
	border-radius: 50px;
	transition: 0.5s all;
	font-weight: bold;
	background-color: #000;
	color: #FFF;
	width: 100%;
	margin-bottom: 20px;
}

.cancel {
	padding: 5px 25px;
	border: 1px solid rgb(71, 194, 194);
	border-radius: 50px;
	transition: 0.5s all;
	font-weight: bold;
	width: 100%;
}

.rating-header-descrition {
	margin-bottom: 15px;
	color: #000;
	font-weight: 600;
}

.rating-larger i {
	font-size: 30px;
	margin-right: 20px;
}

.textarea {
	position: relative;
}

.textarea::before {
	content: "0/100 Words";
	position: absolute;
	top: 10px;
	right: 10px;
}

.textarea textarea {
	width: 100%;
	border: 1px solid rgb(219, 214, 214);
	border-radius: 10px;
	padding: 10px;
	background-color: transparent !important;
	resize: none;
}

label {
	font-size: 26px;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

.rating-larger label {
	font-size: 55px !important;
}

/* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
</style>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="rating-header">
				<div class="header-title"> Add your Reviews for </div>
				<div class="resut-rating">
					<div class="circle"> {{-- <img src="{{ asset('restaurents/'.$restaurent->file)}}" alt="" width="100%"> --}} </div>
					<div class="circle-info">
						<div class="circle-title">{{ $restaurent->name }}</div>
						<div class="circle-description">{{ $restaurent->location }}</div>
						<div class="content-rating"> 
							@for($i=1; $i<=5; $i++ ) 
								@if($i<=$restaurent->overallRating) 
									<i class="fa-solid fa-star"></i> 
								@else 
									<i class="fa-regular fa-star"></i> 
								@endif 
							@endfor 
						</div>
					</div>
				</div>
				<button class="cancel-btn"><a href="{{ url()->previous() }}">Cancel</a></button>
			</div>
			<form action="{{ route('review.store') }}" method="post" id="addReview">
			@csrf
			<div class="rating-header-descrition">Rate this restaurent by giving stars to teh services you were provided</div>
			<div class="">
				<div class="rat-content">
					<div class="rating-card">
						<div class="card-title">Type of Services</div>
						<div class="card-info">Rate the type of service you experianced</div>
					</div>
					<div class="content-info"> 
						@foreach($restaurent->services as $item)
						<div class="rating">
							<div class="content-details">{{ $item->name }}</div>
							<article>
								<div class="star">
									<label>★
										<input type="radio" name="ser{{ $item->id }}" value="1" id="aze"> 
									</label>
									<label>★
										<input type="radio" name="ser{{ $item->id }}" value="2"> 
									</label>
									<label>★
										<input type="radio" name="ser{{ $item->id }}" value="3">
									</label>
									<label>★
										<input type="radio" name="ser{{ $item->id }}" value="4"> 
									</label>
									<label>★
										<input type="radio" name="ser{{ $item->id }}" value="5"> 
									</label>
								</div>
							</article>
						</div> 
						@endforeach
			 		</div>
				</div>
			</div>
			<div class="">
				<div class="rat-content">
					<div class="rating-card">
						<div class="card-title">Type of Foods</div>
						<div class="card-info">Rate the type of food you had</div>
					</div>
					<div class="content-info">
						@foreach($restaurent->foods as $item)
						<div class="rating">
							<div class="content-details"> {{ $item->name }} </div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="food{{ $item->id }}" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="food{{ $item->id }}" value="2"> </label>
									<label> ★
										<input type="radio" name="food{{ $item->id }}" value="3"> </label>
									<label> ★
										<input type="radio" name="food{{ $item->id }}" value="4"> </label>
									<label> ★
										<input type="radio" name="food{{ $item->id }}" value="5"> </label>
								</div>
							</article>
						</div> 
						@endforeach
					</div>
				</div>
			</div>
			<div class="">
				<div class="rat-content">
					<div class="rating-card">
						<div class="card-title">Type of Occasion</div>
						<div class="card-info">Rate the type of occasion you orderd and received</div>
					</div>
					<div class="content-info"> 
						@foreach($restaurent->occasion as $item)
						<div class="rating">
							<div class="content-details"> {{ $item->name }} </div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="occasion{{ $item->id }}" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="occasion{{ $item->id }}" value="2"> </label>
									<label> ★
										<input type="radio" name="occasion{{ $item->id }}" value="3"> </label>
									<label> ★
										<input type="radio" name="occasion{{ $item->id }}" value="4"> </label>
									<label> ★
										<input type="radio" name="occasion{{ $item->id }}" value="5"> </label>
								</div>
							</article>
						</div> 
						@endforeach
					</div>
				</div>
			</div>
			<div class="">
				<div class="rat-content">
					<div class="rating-card">
						<div class="card-title">Type of Meals</div>
						<div class="card-info">Rate the type of dinning options you experianced</div>
					</div>
					<div class="content-info"> 
						@foreach($restaurent->meals as $item)
						<div class="rating">
							<div class="content-details"> {{ $item->name }} </div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="meal{{ $item->id }}" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="meal{{ $item->id }}" value="2"> </label>
									<label> ★
										<input type="radio" name="meal{{ $item->id }}" value="3"> </label>
									<label> ★
										<input type="radio" name="meal{{ $item->id }}" value="4"> </label>
									<label> ★
										<input type="radio" name="meal{{ $item->id }}" value="5"> </label>
								</div>
							</article>
						</div> 
						@endforeach
					</div>
				</div>
			</div>
			<div class="">
				<div class="rat-content">
					<div class="rating-card">
						<div class="card-title">General Restaurent Experiance</div>
						<div class="card-info">Lorem ip odio voluptatum!</div>
					</div>
					<div class="content-info"> 
						<div class="rating">
							<div class="content-details">Average expense of serving per head</div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="expenseRating" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="expenseRating" value="2"> </label>
									<label> ★
										<input type="radio" name="expenseRating" value="3"> </label>
									<label> ★
										<input type="radio" name="expenseRating" value="4"> </label>
									<label> ★
										<input type="radio" name="expenseRating" value="5"> </label>
								</div>
							</article>
						</div> 
						<div class="rating">
							<div class="content-details">Quality of food</div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="foodRating" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="foodRating" value="2"> </label>
									<label> ★
										<input type="radio" name="foodRating" value="3"> </label>
									<label> ★
										<input type="radio" name="foodRating" value="4"> </label>
									<label> ★
										<input type="radio" name="foodRating" value="5"> </label>
								</div>
							</article>
						</div> 
						<div class="rating">
							<div class="content-details">Ambiance of the experiance</div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="ambianceRating" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="ambianceRating" value="2"> </label>
									<label> ★
										<input type="radio" name="ambianceRating" value="3"> </label>
									<label> ★
										<input type="radio" name="ambianceRating" value="4"> </label>
									<label> ★
										<input type="radio" name="ambianceRating" value="5"> </label>
								</div>
							</article>
						</div> 
						<div class="rating">
							<div class="content-details">Quality of service</div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="serviceRating" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="serviceRating" value="2"> </label>
									<label> ★
										<input type="radio" name="serviceRating" value="3"> </label>
									<label> ★
										<input type="radio" name="serviceRating" value="4"> </label>
									<label> ★
										<input type="radio" name="serviceRating" value="5"> </label>
								</div>
							</article>
						</div> 
						<div class="rating">
							<div class="content-details">Cleanliness</div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="cleanlinessRating" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="cleanlinessRating" value="2"> </label>
									<label> ★
										<input type="radio" name="cleanlinessRating" value="3"> </label>
									<label> ★
										<input type="radio" name="cleanlinessRating" value="4"> </label>
									<label> ★
										<input type="radio" name="cleanlinessRating" value="5"> </label>
								</div>
							</article>
						</div> 
						<div class="rating">
							<div class="content-details">Speed of service</div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="speedRating" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="speedRating" value="2"> </label>
									<label> ★
										<input type="radio" name="speedRating" value="3"> </label>
									<label> ★
										<input type="radio" name="speedRating" value="4"> </label>
									<label> ★
										<input type="radio" name="speedRating" value="5"> </label>
								</div>
							</article>
						</div> 
						<div class="rating">
							<div class="content-details">Value for money</div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="valueRating" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="valueRating" value="2"> </label>
									<label> ★
										<input type="radio" name="valueRating" value="3"> </label>
									<label> ★
										<input type="radio" name="valueRating" value="4"> </label>
									<label> ★
										<input type="radio" name="valueRating" value="5"> </label>
								</div>
							</article>
						</div> 
						<div class="rating">
							<div class="content-details">Allergy information provided</div>
							<article>
								<div class="star">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="allergyRating" value="1" id="aze"> </label>
									<label> ★
										<input type="radio" name="allergyRating" value="2"> </label>
									<label> ★
										<input type="radio" name="allergyRating" value="3"> </label>
									<label> ★
										<input type="radio" name="allergyRating" value="4"> </label>
									<label> ★
										<input type="radio" name="allergyRating" value="5"> </label>
								</div>
							</article>
						</div> 
					</div>
				</div>
			</div>
			<div class="">
				<div class="rat-content">
					<div class="rating-card">
						<div class="card-title">Rate Your Overall experiences</div>
					</div>
					<div class="content-info">
						<div class="rating">
							<article>
								<div class="star rating-larger">
									<!-- <input type="radio" name="note" value="1" id="aze"> -->
									<label>
										<!--for='aze'-->★
										<input type="radio" name="overallRating" value="1" id="aze" required> </label>
									<label> ★
										<input type="radio" name="overallRating" value="2" required> </label>
									<label> ★
										<input type="radio" name="overallRating" value="3" required> </label>
									<label> ★
										<input type="radio" name="overallRating" value="4" required> </label>
									<label> ★
										<input type="radio" name="overallRating" value="5" required> </label>
								</div>
							</article>
						</div>
					</div>
				</div>
			</div>
			<div class="">
				<div class="rat-content">
					<div class="rating-card">
						<div class="card-title">Do you have any other comment?</div>
						<div class="card-info">Type in any special comment about your experiance below</div>
					</div>
					<div class="textarea">
						<input type="hidden" name="restaurent_id" value="{{ $restaurent->id }}">
						<textarea name="comment" id="" cols="30" rows="6" placeholder="Type your comments here"></textarea>
					</div>
				</div>
			</div>
			<button class="submit" type="submit">Submit Reviews</button>
			<button class="cancel"><a href="{{ url()->previous() }}">Cancel</a></button>
			</form>
		</div>
	</div>
</div>
<script>
	const LABELCOLORINACTIV = "#ced4da";
	const LABELCOLORACTIV = "#921c22";
	const RATINGSLABELS = document.querySelectorAll(".star label");
	const RATINGSINPUTS = document.querySelectorAll(".star input");
	// make inputs disappear
	RATINGSINPUTS.forEach(function(anInput) {
		anInput.style.display = "none";
	});
	// manage label click & hover display
	function notationLabels(e) {
		let currentLabelRed = e.target;
		let currentLabelBlack = e.target;
		// console.log(e.target.localName);
		if(e.type == "mouseenter" || !e.target.control.checked) {
			// coloring red from the clicked/hovered label included, going backward till the node start - if we are hovering or the star isn't already checked.
			while(currentLabelRed != null) {
				currentLabelRed.style.color = LABELCOLORACTIV;
				currentLabelRed = currentLabelRed.previousElementSibling;
			}
			// coloring black from the clicked/hovered label excluded, going forward till the node end
			while((currentLabelBlack = currentLabelBlack.nextElementSibling) != null) {
				currentLabelBlack.style.color = LABELCOLORINACTIV;
			}
		} else {
			// if the clicked label was already checked we uncheck it and prevent the click event from doing its job - defacto enabling zero star rating
			e.target.control.checked = false;
			e.preventDefault();
		}
	}

	function notationLabelsOut(e) {
		let notesNode = e.target.parentNode.querySelectorAll("label");
		let currentLabel = notesNode[notesNode.length - 1];
		// console.log("out : " + e.target.localName);
		// console.log("out checked: " + e.target.control.checked);
		notesNode.forEach(function redrum(starLabel) {
			starLabel.style.color = LABELCOLORACTIV;
		});
		while(currentLabel != null && !currentLabel.control.checked) {
			currentLabel.style.color = LABELCOLORINACTIV;
			currentLabel = currentLabel.previousElementSibling;
			//console.log("currentLabel null?: " + currentLabel);
			// previousElementSibling become the input ...
		}
	}
	document.addEventListener("DOMContentLoaded", function() {
		RATINGSLABELS.forEach(function(aStar) {
			aStar.style.color = "#ced4da";
			aStar.addEventListener("click", notationLabels);
			aStar.addEventListener("mouseenter", notationLabels);
			aStar.addEventListener("mouseout", notationLabelsOut);
		});
		// stop a callback to the label click event function notationLabels passed on the input element associated ... why ... that's behond me
		// alternatively we could check for e.target.localName in the notationLabels function
		RATINGSINPUTS.forEach(function(aStarInput) {
			aStarInput.addEventListener("click", function(e) {
				e.stopPropagation();
			});
		});
	});
</script> 
@endsection