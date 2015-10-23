@extends('templates/main')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="/dev" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label for="title">Title:</label>
					<input type="text" name="title" id="title" class="form-control">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection