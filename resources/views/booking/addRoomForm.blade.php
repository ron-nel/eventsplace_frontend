@extends('booking.template')

@section("title", "Add Room")

@section('content')
<div class="section homePage">
	<div class="row">
		<div class="col-8 offset-2 my-5">
			<div class="row">
				<div class="col-12 content-holder p-5 rounded">
			<h3 class="text-center">Add Room</h3>
		
		<form action="/admin/addRoom" method="post" enctype="multipart/form-data" class="">
			@csrf
			<div class="form-group">
				<label for="roomName">Room Name</label>
				<input type="text" class="form-control" id="roomName" name="roomName">
			</div>
			<div class="form-group">
				<label for="roomLocation">Room Location</label>
				<input type="text" class="form-control" id="roomLocation" name="roomLocation">
			</div>
			<div class="form-group">
				<label for="roomCapacity">Room Capacity</label>
				<input type="text" class="form-control" id="roomCapacity" name="roomCapacity">
			</div>
			<div class="form-group">
				<label for="roomArea">Room Area</label>
				<input type="text" class="form-control" id="roomArea" name="roomArea">
			</div>
			<div class="form-group">
				<label for="roomCeiling">Room Ceiling</label>
				<input type="text" class="form-control" id="roomCeiling" name="roomCeiling">
			</div>
			<div class="form-group">
				<label for="roomPrice">Room Price</label>
				<input type="number" class="form-control" id="roomPrice" name="roomPrice">
			</div>
			<div class="form-group">
				<label for="roomImage">Room Image</label>
				<input type="file" class="form-control" id="roomImage" name="roomImage">
			</div>
			<button class="btn btn-block btn1">Save</button>
		</form>
	</div>
</div>
</div>
</div>
</div>

@endsection