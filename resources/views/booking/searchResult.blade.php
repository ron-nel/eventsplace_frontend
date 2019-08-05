@extends('booking.template')

@section("title", "Available Rooms")

@section('content')
<div class="section homePage2">
	<div class="row">
		<div class="col-8 offset-2 my-5">
			<div class="row">
				<div class="col-12 content-holder px-5 py-3 rounded">
					<h3 class="text-center">Here are our available rooms</h3>
					@foreach($newRooms as $availableRoom)
					<div class="card mb-3">
						<div class="row no-gutters">
							<div class="col-md-4">
								<img src="{{asset("$availableRoom->roomImage")}}" class="card-img" alt="...">
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<table class="table">
											<tbody>
											<tr>
												<td>Name</td>
												<td>{{$availableRoom->roomName}}</td>
											</tr>
											<tr>
												<td>Location</td>
												<td>{{$availableRoom->roomLocation}}</td>
											</tr>
											<tr>
												<td>Capacity</td>
												<td>{{$availableRoom->roomCapacity}}</td>
											</tr>
											<tr>
												<td>Dimension</td>
												<td>{{$availableRoom->roomArea}}</td>
											</tr>
											<tr>
												<td>Ceiling</td>
												<td>{{$availableRoom->roomCeiling}}</td>
											</tr>
											<tr>
												<td>Price (Php)</td>
												<td>{{$availableRoom->roomPrice}}</td>
											</tr>
										</tbody>
									</table>

								</div>
								@if(Session()->has('user'))
								<form action="/stripe/{{$availableRoom->_id}}" method="POST" class="form-group mx-4 my-5">
									@csrf
									{{method_field("POST")}}
									{{-- <input type="hidden" value="{{$availableRoom->_id}}" name="roomId" id="roomId" class="form-control">
									<input type="hidden" value="{{$availableRoom->roomName}}" name="roomName" id="roomName" class="form-control">
									@if(isset($availableRoom->roomPrice))
									<input type="hidden" value="{{$availableRoom->roomPrice}}" name="roomPrice" id="roomPrice" class="form-control">
									@endif --}}
									<input type="hidden" value="{{$request->startDate}}" name="startDate" id="startDate" class="form-control">
									<input type="hidden" value="{{$request->endDate}}" name="endDate" id="endDate" class="form-control">
									<button class="btn btn-sm btn1 text-white">Proceed To Booking</button>
								</form>
								@else
								<button class="btn btn-sm btn1 text-white mx-4 my-5" data-target="#signin" data-toggle="modal" >Proceed To Booking</button>
								<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content content-holder">
										<div class="modal-body text-center">
											You are not logged-in yet. Login first to proceed to booking.
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn2 btn-sm text-white" data-dismiss="modal">Close</button>
											<a href="/auth/loginpage" class="btn btn1 btn-sm text-white">Login</a>
										</div>
									</div>
								</div>
							</div>
							@endif

{{-- 	<form action="/reserveRoom" method="POST" class="form-group">
@csrf
{{method_field("POST")}}
<input type="hidden" value="{{$availableRoom->_id}}" name="roomId" id="roomId" class="form-control">
<input type="hidden" value="{{$request->startDate}}" name="startDate" id="startDate" class="form-control">
<input type="hidden" value="{{$request->endDate}}" name="endDate" id="endDate" class="form-control">
<button class="btn btn-sm btn-success">Book</button>
</form> --}}
</div>
</div>
</div>
@endforeach

</div>
</div>
</div>
</div>
</div>

@endsection