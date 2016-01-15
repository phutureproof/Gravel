@extends('templates/bootstrap')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="page-header">
				<h1>Please login to continue</h1>
			</div>
			<form action="/admin/login" method="post" accept-charset="utf-8" class="">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" name="email" id="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" class="form-control" required>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection