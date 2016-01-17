@extends('templates/admin')
@section('content')

<a href="<?= $url . '/create'; ?>" class="btn btn-primary">Create <?= $model; ?></a>

<br>

<?= $pagination; ?>

<?php if (count($records) > 0): ?>
	<table class="table table-striped table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<?php foreach ($tableHeaders as $header): ?>
					<th><?= strtoupper(str_replace("_", " ", $header)); ?></th>
				<?php endforeach; ?>
				<th style="width: 5%;">OPTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($records as $record): ?>
				<tr>
					<?php foreach ($tableHeaders as $property): ?>
						<td>
							<div style="overflow: hidden; max-height: 25px;">
								<?= substr(strip_tags($record->$property), 0, 100); ?>
							</div>
						</td>
					<?php endforeach; ?>
					<td nowrap>
						<a href="<?= $url . '/edit/' . $record->id; ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="<?= $url . '/delete/' . $record->id; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<div class="alert alert-info">
		<p>There are no records to display, please use the button above to create a new record.</p>
	</div>
<?php endif; ?>
@endsection