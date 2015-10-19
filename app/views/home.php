@extends('templates/main')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="#Routing">Routing</a>
				<li><a href="#Models">Models</a></li>
				<li><a href="#Views">Views</a></li>
				<li><a href="#Controllers">Controllers</a></li></li>
			</ul>
		</div>
		<div class="col-md-10">
			@include('documentation/routing')
			@include('documentation/models')
			@include('documentation/views')
			@include('documentation/controllers')
		</div>
	</div>
</div>


@endsection

@section('javascript')
<script>
	!function ($, undefined) {

		$(function() {

			$(document).on('click', '.nav a', function (e) {
				var $this = $(this);
				var $parentContainer = $this.parents('.nav:first');
				$parentContainer.find('li.active').removeClass('active');
				$this.parents('li:first').addClass('active');
			});

		});

	}(jQuery);
</script>
@endsection