<?php use Gravel\Gravel; ?>
<ul class="nav nav-pills">
	<li class="<?= Gravel::$request->uri == '/' ? 'active' : null; ?>"><a href="/">Home</a></li>
	<li class="<?= Gravel::$request->uri == '/about' ? 'active' : null; ?>"><a href="/about">About</a></li>
</ul>