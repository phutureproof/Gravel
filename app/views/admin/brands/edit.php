<?php
use Gravel\Scaffolding;

?>
@extends('templates/admin')
@section('content')
@include('utilities/form-errors')
<?= Scaffolding::createEditForm('brands', 'Brand', $id); ?>
@endsection