@extends('templates/admin')
@section('content')
<a href="/admin/blog/create" class="btn btn-primary">Create Post</a>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th style="width: 5%;">Options</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $post): ?>
			<tr>
				<td><?= $post->title; ?></td>
				<td nowrap>
					<a href="/admin/blog/edit/<?= $post->id; ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="/admin/blog/delete/<?= $post->id; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
@endsection