<?php
use Gravel\Scaffolding;

?>
@extends('templates/admin')
@section('content')
@include('utilities/form-errors')
<?= Scaffolding::createEditForm('blog_posts', 'Blog', $id); ?>
@endsection
