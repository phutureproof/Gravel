<?php
use Gravel\Scaffolding;

?>
@extends('templates/admin')
@section('content')
@include('utilities/form-errors')
<?= Scaffolding::createEditForm('users', 'User', $id); ?>
@endsection