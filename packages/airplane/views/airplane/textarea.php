	<div class="form-group">
		<label><?= Inflector::humanize($name) ?></label>
		<textarea class="form-control" name="<?= $name ?>"><?= $object->{$name} ?></textarea>
	</div>