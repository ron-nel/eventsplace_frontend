@extends('booking.template')

@section("title", "Update Room")

@section('content')
<div class="row my-5">
	<div class="col-8 offset-2">
		<div class="text-center">
			<h1>Update Room</h1>
		</div>
		<form action="/admin/updateRoom/{{$room->_id}}" method="post" enctype="multipart/form-data" class="form-control">
			@csrf
			{{method_field('PUT')}}
			<div class="form-group">
				<label for="roomName">Room Name</label>
				<input type="text" class="form-control" id="roomName" name="roomName" value="{{$room->roomName}}">
			</div>
			<div class="form-group">
				<label for="roomLocation">Room Location</label>
				<input type="text" class="form-control" id="roomLocation" name="roomLocation" value="{{$room->roomLocation}}">
			</div>
			<div class="form-group">
				<label for="roomImage">Room Image</label>
				<input type="file" class="form-control" id="roomImage" name="roomImage">
			</div>
			<button class="btn">Save</button>
		</form>
	</div>
</div>

@endsection