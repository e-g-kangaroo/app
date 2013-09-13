	<div class="form-group">
		<label><?= Inflector::humanize($name) ?></label>
		<select class="form-control" name="<?= $name ?>">
			<?php foreach ($structure['enum'] as $item): ?>
				<option value="<?= $item ?>"<?= $item == Input::post($name, $object->{$name}) ? ' selected' : '' ?>><?= $item ?></option>
			<?php endforeach; ?>
		</select>
	</div>