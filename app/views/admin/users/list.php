@extends('templates/admin')
@section('content')
<a href="/admin/users/create" class="btn btn-primary">Create User</a>
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th style="width: 5%;">Options</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?= $user->username; ?></td>
				<td><?= $user->email; ?></td>
				<td nowrap>
					<a href="/admin/users/edit/<?= $user->id; ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="/admin/users/delete/<?= $user->id; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
@endsection