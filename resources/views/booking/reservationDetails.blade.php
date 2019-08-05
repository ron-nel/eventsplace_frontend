
@extends('booking.template')

@section("title", "Available Rooms")

@section('content')
<div class="section homePage2">
	<div class="row">
		<div class="col-8 offset-2 my-5">
			<div class="row">
				<div class="col-12 content-holder px-5 py-3 rounded">
					<h3 class="text-center">Here are our available rooms</h3>
					<div class="card mb-3" style="">
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection