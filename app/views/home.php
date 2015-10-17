@extends('templates/main')

@section('content')

<h1>This is a header, a H1 to be precise!</h1>
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
		<?php foreach ($users as $user ): ?>
		<tr>
			<td><?= $user->getName; ?></td>
			<td><?= $user->email; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
@endsection

@section('javascript')
<script>
	!function () {

		console.log('testing content areas within Gravel framework.')

	}()
</script>
@endsection