	<div class="form-group">
		<label><?= Inflector::humanize($name) ?></label>
		<input class="form-control" name="<?= $name ?>" value="<?= Input::post($name, $object->{$name}) ?>">
	</div>