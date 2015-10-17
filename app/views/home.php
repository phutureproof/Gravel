@extends('templates/main')

@section('content')
<h2>This is a header</h2>
<div class="well well-sm">
	<p>This code is coming from /views/home.php</p>
	<?php if (isset($users)): ?>
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?= $user->firstname ?> <?= $user->lastname; ?></td>
						<td><?= $user->email; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</div>
@endsection

@section('javascript')
<script>
	!function () {

		console.log('testing content areas within Gravel framework.')

	}()
</script>
@endsection