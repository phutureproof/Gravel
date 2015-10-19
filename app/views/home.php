<?php

use Gravel\Core\TemplateEngine;

TemplateEngine::setPageTitle('Gravel Framework');
?>

@extends('templates/main')

@section('content')
<h2>This is a header</h2>
<div class="well well-sm">
	<form action="/notallowed" method="post" accept-charset="utf-8">
		<div class="formgroup">
			<label for="">Input[]</label>
			<input type="text" name="input[]" id="" class="form-control"></div>
		<div class="formgroup">
			<label for="">Input[]</label>
			<input type="text" name="input[]" id="" class="form-control"></div>
		<div class="formgroup">
			<label for="">Input[]</label>
			<input type="text" name="input[]" id="" class="form-control"></div>
		<button class="btn btn-block btn-primary">SEND</button>
	</form>
</div>
@endsection

@section('javascript')
<script>
	!function () {

		console.log('testing content areas within Gravel framework.')

	}()
</script>
@endsection