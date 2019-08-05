@extends('booking.template')

@section("title", "All Rooms")

@section('content')
<div class="section homePage2">
	<div class="row">
		<div class="col-10 offset-1 my-5">
			<div class="row">
				<div class="col-12 content-holder rounded">
					<table class="table my-2">
						<thead class="thead-light">
							<tr>
								<th scope="col">Reference Number</th>
								<th scope="col">Room ID</th>
								<th scope="col">Date</th>
								<th scope="col">Email</th>
								<th scope="col">Price</th>
								<th scope="col">Price</th>
								<th scope="col"></th>
							</tr>
						</thead>
						@foreach($reservations as $reservation)
						<tbody>
							<tr>
								<td>{{$reservation->_id}}</td>
								<td>{{$reservation->roomId}}</td>
								<td>{{$reservation->startDate}}</td>
								<td>{{$reservation->userEmail}}</td>
								<td>{{$reservation->roomPrice}}</td>
								<td><a href="/viewReservationDetails/{{$reservation->roomId}}" class="btn btn1 btn-sm text-white	">View Details</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endsection