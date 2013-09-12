	<div class="form-group">
		<label><?= Inflector::humanize($name) ?></label>
		<textarea class="form-control form-control-content" rows="12" name="<?= $name ?>"><?= $object->{$name} ?></textarea>
	</div>