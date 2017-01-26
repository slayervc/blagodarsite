<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<h2 class="personal-content__header">Шаблон компонента</h2>
<?php if ($arParams['DEBUG'] == 'Y'): ?>
	<div class="alert alert-warning">
		<p>Debug mode:</p>
		<p>Debug $arResult:</p>
		<pre><?php var_dump($arResult) ?></pre>
		<p>Debug $arParams:</p>
		<pre><?php var_dump($arParams) ?></pre>
	</div>
<?php endif ?>
<hr>
<div class="row">
	<div class="col-md-12">
		<form action="<?php echo $arResult['FORM_OPTIONS']['FORM_ACTION'] ?>" method="POST" class="form">
			<?php foreach ($arResult['SHOW_FIELDS'] as $field):?>
				<div class="form-group">
					<input type="text" class="form-control" name="<?php echo $field ?>" placeholder="<?php echo GetMessage($field) ?>">
				</div>
			<?php endforeach ?>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="<?php echo GetMessage('SUBMIT_BUTTON') ?>">
			</div>
		</form>
	</div>
	<script>
		var submitFormOptions = {
			<?php foreach ($arResult['JS_OPTIONS'] as $jsOptionKey => $jsOptionValue): ?>
				<?php echo $jsOptionKey ?> : "<?php echo $jsOptionValue ?>",
			<?php endforeach ?>
		};
	</script>
</div>




