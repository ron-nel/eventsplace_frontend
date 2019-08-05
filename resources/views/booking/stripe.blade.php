@extends('booking.template')

@section("title", "Payment")

@section('content')
<div class="section homePage">
	<div class="row">
		<div class="col-8 offset-2 my-5">
			<div class="row">
				<div class="col-12 content-holder px-5 py-3 rounded">
					<div class="card mb-3">
						<div class="row no-gutters">
							<div class="col-md-4">
								<img src="{{asset("$posts->roomImage")}}" class="card-img" alt="...">
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<table class="table">
										<tbody>
											<tr>
												<td>Name</td>
												<td>{{$posts->roomName}}</td>
											</tr>
											<tr>
												<td>Location</td>
												<td>{{$posts->roomLocation}}</td>
											</tr>
											<tr>
												<td>Capacity</td>
												<td>{{$posts->roomCapacity}}</td>
											</tr>
											<tr>
												<td>Dimension</td>
												<td>{{$posts->roomArea}}</td>
											</tr>
											<tr>
												<td>Ceiling</td>
												<td>{{$posts->roomCeiling}}</td>
											</tr>
											<tr>
												<td>Price (Php)</td>
												<td>{{$posts->roomPrice}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
		<form action="/charge/{{$posts->_id}}" method="POST">
			@csrf
			<script type="text/javascript" src="/javascripts/jquery-3.1.1.min.js"></script>
			<script
			src="https://checkout.stripe.com/checkout.js"
			class="stripe-button"
			data-key="pk_test_V7jy3gqXKYCHZeCsneBdFO8U00q9mJvWnd"
			data-image=""
			data-name="{{Session('user')->name}}"
			data-description="Payment for your Membership"
			data-currency="php"
			data-amount={{$posts->roomPrice}}00
			>
		</script>
		{{-- <h1>{{$requests->roomName}}</h1> --}}

		<input type="hidden" name="roomId" value={{$posts->_id}}>
		<input type="hidden" name="startDate" value={{$request->startDate}}>
		<input type="hidden" name="endDate" value={{$request->endDate}}>
		<input type="hidden" name="userEmail" value={{Session('user')->email}}>
		<input type="hidden" name="price" value={{$posts->roomPrice}}>
		<input type="hidden" name="clientEmail" value="{{Session('user')->name}}">
	</form>
</div>
</div>
</div>
</div>
</div>

@endsection