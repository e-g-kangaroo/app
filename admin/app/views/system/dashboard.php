	<div class="container">
		<h1>Dashboard</h1>
		<div class="well">
			<?= Markdown::parse(File::read(ADMINPATH.'README.md', true)) ?>
		</div>
	</div>