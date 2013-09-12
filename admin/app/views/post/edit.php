	<div class="container">
		<ol class="breadcrumb">
			<li><?= Html::link_to_type($type) ?></li>
			<li><?= $post->title() ?></li>
		</ol>
	</div>
	<form class="container" role="form">
		<div class="row">
			<div class="col-md-8">
				<?php foreach ( $post->form_map() as $name => $property ): ?>
					<?= View::forge('airplane/'.$property['form'], array('object' => $post, 'name' => $name)) ?>
				<?php endforeach; ?>
			</div>
			<div class="col-md-4">
				<?= Form::submit('', 'Update '.Inflector::humanize($type), array('class' => 'btn btn-primary btn-block')) ?>
			</div>
		</div>
	</form>