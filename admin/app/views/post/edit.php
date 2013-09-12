	<form class="container" role="form">
		<div class="row">
			<div class="col-md-8">
				<?php foreach ( $post->form_map() as $name => $property ): ?>
					<?= View::forge('airplane/'.$property['form'], array('object' => $post, 'name' => $name)) ?>
				<?php endforeach; ?>
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</form>