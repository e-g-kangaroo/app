<html>
	<head>
		<meta charset="UTF-8">
		<title>Skyroof <?= isset($title) ? ' | ' . $title : '' ?></title>
		<?= Asset::css('bootstrap.min.css') ?>
		<?= Asset::css('admin.css') ?>
		<?= Asset::js('bootstrap.min.js') ?>
	</head>
	<body>
		<header class="navbar navbar-default navbar-fixed-top" role="banner">
			<div class="container">
				<a class="navbar-brand" href="<?= Uri::create('/') ?>">Skyroof</a>
				<div class="navbar-header">
				</div>
				<nav class="collapse navbar-collapse navbar-ex1-collapse">
				</nav>
			</div>
		</header>
		<?= isset($content) ? $content : 'No Content' ?>
		<footer class="admin-footer" role="contentinfo">
			<div class="container">
				<div class="social">
					<ul class="social-buttons">
						<li><iframe src="http://ghbtns.com/github-btn.html?user=skyroof&repo=app&type=watch&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="100" height="20"></iframe></li>
						<li><iframe src="http://ghbtns.com/github-btn.html?user=skyroof&repo=app&type=fork&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="100" height="20"></iframe></li>
					</ul>
				</div>
				<p>Skyroof ver <?= Skyroof::version() ?>.</p>
				<p>Code Licensed under MIT License.</p>
			</div>
		</footer>
	</body>
</html>