<?php foreach ($posts as $post): ?>
<div class="container">
	<h3><?= $post->title ?></h3>
	<p><?= $post->content ?></p>
</div>
<?php endforeach; ?>