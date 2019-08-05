@extends("booking.template")

@section("title", "Register")

@section("content")
<div class="section homePage">
	<div class="row">
		<div class="col-8 offset-2 my-5">
			<div class="row">
				<div class="col-12 content-holder px-5 py-3 rounded">
	
				<h3 class="text-center">Register</h3>
				<form action="/auth/submitregister" method="POST" class="form-group">
					@csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<input type="hidden" name="role" id="role" value="2">
					<button class="btn btn-block text-white btn1">Submit</button>
				</form>
			</div>
		</div>
	</div>
	</div>
		</div>
	</div>
@endsection