@extends('templates/main')

@section('content')
<h1>This is a header, a H1 to be precise!</h1>
<p>This code is coming from /views/home.php</p>
@endsection

@section('javascript')
<script>
	!function () {

		console.log('testing content areas within Gravel framework.')

	}()
</script>
@endsection