@extends('templates/main')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<table class="table-bordered table-condensed table-hover table-striped">
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
				</tr>

				<?php foreach ($users as $user) : ?>
					<tr>
						<td><?= $user->firstname; ?></td>
						<td><?= $user->lastname; ?></td>
						<td><?= $user->email; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
			<?= $pagination; ?>
		</div>
	</div>
</div>

@endsection
