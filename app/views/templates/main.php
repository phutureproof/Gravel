<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?= \Gravel\TemplateEngine::getPageTitle(); ?></title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h1>Gravel PHP Framework</h1>
					</div>
				</div>
			</div>
		</div>

		@yield('content')

		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		@yield('javascript')

	</body>
</html>
