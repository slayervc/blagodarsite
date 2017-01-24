<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?php if ($arParams['DEBUG']): ?>
	<p class="text-center alert alert-warning">
		<strong>Debug mode</strong>
	</p>
<?php endif ?>
<div class="com-md-12">
	<?php if ($arResult['RESPONSE_STATUS'] == 'ERROR'): ?>
		<p class="text-center alert alert-danger">
			<?php foreach ($arResult['RESPONSE_STATUS'] as $error): ?>
				<strong><?php echo $error ?></strong><br />
			<?php endforeach ?>
		</p>
	<?php endif ?>
	<form action="<?php echo $arParams['FORM_ACTION'] ?>" method="POST" class="form">
		<div class="col-md-6">
			<input type="text" class="form-control" name="cl-login">
		</div>
		<div class="col-md-6">
			<input type="submit" class="btn btn-default" name="submit">
		</div>
	</form>
</div>


