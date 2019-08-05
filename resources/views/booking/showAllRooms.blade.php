@extends('booking.template')

@section("title", "All Rooms")

@section('content')
<div class="section homePage2">
	<div class="row">
		<div class="col-8 offset-2 my-5">
			<div class="row">
				<div class="col-12 content-holder px-5 py-3 rounded">
					<h3 class="text-center">All Rooms</h3>
					@foreach($rooms as $room)
					<div class="card mb-3 p-2">
						<div class="row no-gutters">
							<div class="col-md-4">
								<img src="{{asset("$room->roomImage")}}" class="card-img" alt="...">
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<table class="table">
										<tbody>
											<tr>
												<td>Name</td>
												<td>{{$room->roomName}}</td>
											</tr>
											<tr>
												<td>Location</td>
												<td>{{$room->roomLocation}}</td>
											</tr>
											<tr>
												<td>Capacity</td>
												<td>{{$room->roomCapacity}}</td>
											</tr>
											<tr>
												<td>Dimension</td>
												<td>{{$room->roomArea}}</td>
											</tr>
											<tr>
												<td>Ceiling</td>
												<td>{{$room->roomCeiling}}</td>
											</tr>
											<tr>
												<td>Price (Php)</td>
												<td>{{$room->roomPrice}}</td>
											</tr>
										</tbody>
									</table>
								</div>
								<button type="button" data-toggle="modal" data-target="#{{$room->_id}}" class="btn btn-sm text-dark btn3 ml-4">Delete Room</button>
								<a href="/admin/updateRoomForm/{{$room->_id}}" class="btn btn-sm text-white btn2">Update Room</a>

								<div class="modal fade" id="{{$room->_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content content-holder">
										<div class="modal-body text-center">
											Are you sure you want to delete this item?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn2 btn-sm text-white" data-dismiss="modal">Close</button>
											<a href="/admin/deleteRoom/{{$room->_id}}" class="btn btn1 btn-sm text-white">Delete</a>
										</div>
									</div>
								</div>
							</div>
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