<?php use Gravel\Gravel; ?>

@extends('templates/main')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6">

			<table class="table-bordered table-condensed table-hover table-striped">
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Options</th>
				</tr>

				<?php foreach ($users as $user) : ?>
					<tr>
						<td><?= $user->firstname; ?></td>
						<td><?= $user->lastname; ?></td>
						<td><?= $user->email; ?></td>
						<td>
							<a class="btn btn-danger" href="/delete/<?= $user->id; ?>"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
				<?php endforeach; ?>

			</table>

			<?= $pagination; ?>
		</div>
		<div class="col-md-6">
			<button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target=".formWrapper">Create User</button>
			<div class="formWrapper <?php if (!Gravel::$formErrors): ?>collapse<?php endif; ?>">
				<div class="well">@include('create-user-form')</div>
			</div>
        </div>
	</div>
</div>

@endsection
