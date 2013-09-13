	<div class="form-group">
		<label><?= Inflector::humanize($name) ?></label>
		<input type="datetime" class="form-control" name="<?= $name ?>" value="<?= $object->{$name} ?>">
	</div>