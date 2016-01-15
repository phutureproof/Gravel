@extends('templates/admin')
@section('content')
<a href="/admin/brands/create" class="btn btn-primary">Create Brand</a>
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th style="width: 5%;">Options</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($brands as $brand): ?>
			<tr>
				<td><?= $brand->title; ?></td>
				<td nowrap>
					<a href="/admin/brands/edit/<?= $brand->id; ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="/admin/brands/delete/<?= $brand->id; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
@endsection