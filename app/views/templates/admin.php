<?php
use Gravel\Gravel;
use Gravel\TemplateEngine;

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?= TemplateEngine::getPageTitle(); ?></title>

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
		<link href="/public/css/admin.css" rel="stylesheet">

		<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/admin/dashboard"><?= $_SERVER['SERVER_NAME']; ?></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome <?= $_SESSION['admin-username']; ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="/admin/logout">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container-fluid" style="margin-top: 20px;">
			<div class="row">
				<div class="col-md-2">
					<ul class="nav nav-pills nav-stacked">
						<li class="<?= (preg_match('/dashboard/', Gravel::$request->uri)) ? 'active' : null; ?>"><a href="/admin/dashboard"><span class="glyphicon glyphicon-home"></span> Home</a></li>
						<li class="separator"></li>
						<li class="<?= (preg_match('/users/', Gravel::$request->uri)) ? 'active' : null; ?>"><a href="/admin/users"><span class="glyphicon glyphicon-th-list"></span> Users</a></li>
						<li class="<?= (preg_match('/blog/', Gravel::$request->uri)) ? 'active' : null; ?>"><a href="/admin/blog"><span class="glyphicon glyphicon-th-list"></span> Blog Posts</a></li>
						<li class="<?= (preg_match('/brands/', Gravel::$request->uri)) ? 'active' : null; ?>"><a href="/admin/brands"><span class="glyphicon glyphicon-th-list"></span> Brands</a></li>
					</ul>
				</div>
				<div class="col-md-10 content-container">
					@yield('content')
				</div>
			</div>
		</div>

		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.3/summernote.css" rel="stylesheet">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.3/summernote.js"></script>
		<script src="/public/js/admin.js"></script>

		@yield('javascript')
	</body>
</html>
