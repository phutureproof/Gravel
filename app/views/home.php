<?php

use Gravel\Core\TemplateEngine;

TemplateEngine::setPageTitle('Gravel Framework');
?>

@extends('templates/main')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<div class="list-group">
				<a href="#Models" class="list-group-item active">Models</a>
				<a href="#Views" class="list-group-item">Views</a>
				<a href="#Controllers" class="list-group-item">Controllers</a>
				<a href="#Routing" class="list-group-item">Routing</a>
			</div>
		</div>
		<div class="col-md-10">
			@include('includes/test')
		</div>
	</div>
</div>


@endsection

@section('javascript')
<script>
	!function ($, undefined) {

		$(function() {

			$(document).on('click', 'a.list-group-item', function (e) {
				var $this = $(this);
				var $parentContainer = $this.parents('.list-group:first');
				$parentContainer.find('a.active').removeClass('active');
				$this.addClass('active');
			});

		});

	}(jQuery)
</script>
@endsection