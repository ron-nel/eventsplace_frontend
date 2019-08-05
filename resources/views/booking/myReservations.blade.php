@extends('booking.template')

@section("title", "My Reservations")

@section('content')
<div class="section homePage2">
	<div class="row">
		<div class="col-10 offset-1 my-5">
			<div class="row">
				<div class="col-12 content-holder px-5 py-3 rounded">
					<table class="table my-2">
						<thead class="thead-light">
							<tr>
								<th scope="col">Reference Number</th>
								<th scope="col">Date</th>
								<th scope="col">Price</th>
								<th></th>
							</tr>
						</thead>
					@foreach($reservations as $reservation)
						<tbody>
							<tr>
								<td>{{$reservation->_id}}</td>
								<td>{{$reservation->startDate}}</td>
								<td>{{$reservation->roomPrice}}</td>
								<td><a href="/viewReservationDetails/{{$reservation->roomId}}" class="btn btn1 btn-sm text-white">View</a><button type="button" class="btn btn1 btn-sm text-white mx-3" data-toggle="modal" data-target="#{{$reservation->_id}}">Cancel</button></td>
							</tr>

							<div class="modal fade" id="{{$reservation->_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content content-holder">
										<div class="modal-body text-center">
											Are you sure you want to cancel your reservation?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn2 btn-sm text-white" data-dismiss="modal">Close</button>
											<a href="/cancelReservation/{{$reservation->_id}}" class="btn btn1 btn-sm text-white">Cancel</a>
										</div>
									</div>
								</div>
							</div>
					@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection