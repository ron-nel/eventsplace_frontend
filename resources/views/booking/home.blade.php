@extends('booking.template')

@section("title", "Home")

@section('content')
<div class="section homePage">
	<div class="row">
		<div class="col-8 offset-2 my-5">
			<div class="row">
				<div class="col-12 content-holder p-5 rounded">
					<div class="content p-2">
						<h3>Your Event, Our Place.</h3><br>
						<p>What's cooking? Planning a product launch? Another Unforgettable Party? We got a perfect place for you. </p>
						<p>Tell us where you need it and when you need it to choose from our events place.</p>
					</div>
					<form action="/search" method="post" class="col-12">
						@csrf
						<div class="row">
							<div class="col-12">
								
						{{-- <div class="form-group">
							<label for="location">Location</label>
							<select id="location" name="location" class="form-control">
								<option value="all">All</option>
								<option value="Makati">Makati</option>
								<option value="Manila">Manila</option>
								<option value="Pasig">Pasig</option>
							</select>
						</div> --}}
						</div>
						<div class="col">
						<div class="form-group">
							<label for="location">Location</label>
							<select id="location" name="location" class="form-control">
								<option value="all">All</option>
								<option value="Makati">Makati</option>
								<option value="Manila">Manila</option>
								<option value="Pasig">Pasig</option>
							</select>
						</div>
						</div>
						<div class="col">
						<div class="form-group">
							<label for="startDate">Start Date</label>
							<input type="date" class="form-control" id="startDate" name="startDate" onchange="return handleChangeStart(e)">
						</div>
						</div>
						</div>
						<button class="btn btn-block btn1 text-white">Search</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

let today = new Date();
today.setDate(today.getDate() + 15);
let newToday = today.toISOString().split('T')[0];
// console.log(newToday);

let startMaxDay = new Date();
startMaxDay.setDate(startMaxDay.getDate() + 366);
let newStartMaxDay = startMaxDay.toISOString().split('T')[0];

let tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 15);
let newTomorrow = tomorrow.toISOString().split('T')[0];

let endMaxDay = new Date();
endMaxDay.setDate(endMaxDay.getDate() + 367);
let newEndMaxDay = endMaxDay.toISOString().split('T')[0];

let startDate = document.getElementById('startDate');
let endDate = document.getElementById('endDate');

startDate.setAttribute("min", newToday);
startDate.setAttribute("value", newToday);
startDate.setAttribute("max", newStartMaxDay);

endDate.setAttribute("min", newTomorrow);
endDate.setAttribute("value", newTomorrow);
endDate.setAttribute("max", newEndMaxDay);


let log = document.getElementById('log');

startDate.onchange = handleChangeStart;
endDate.onchange = handleChangeEnd;


function handleChangeStart(e) {
	let newInput = e.target.value;
	endDate.setAttribute("min", newInput);
	endDate.setAttribute("value", newInput);
	// console.log("hello");
};

function handleChangeEnd(e) {
	let newInput = e.target.value;
	startDate.setAttribute("max", newInput);
	startDate.setAttribute("value", newInput);
};

// console.log(endDate.value);


</script>
@endsection