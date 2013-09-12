	<?php foreach ($posts as $post): ?>
	<div class="container">
		<h3><?= Html::anchor('post/'.$type.'/edit/'.$post->id, $post->title()) ?></h3>
		<p><?= $post->content() ?></p>
	</div>
	<?php endforeach; ?>