<?php
use Gravel\Scaffolding;

?>

@extends('templates/admin')
@section('content')
@include('utilities/form-errors')
<?= Scaffolding::createInsertForm('users', 'User'); ?>
@endsection