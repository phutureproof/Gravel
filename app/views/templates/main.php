<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Template Tests</title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="jumbotron">
						<h1>This is the main template</h1>
					</div>
				</div>
				<div class="col-md-12">
					@yield('content')
				</div>
			</div>
		</div>
	</body>
</html>
