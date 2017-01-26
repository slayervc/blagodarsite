<?php if ($arParams['DEBUG'] == 'Y'): ?>
	<p class="alert alert-warning">Debug mode enabled</p>
<?php endif ?>
<h1 class="personal-content__header">
	Получить информацию о клиенте
</h1>
<div class="row">
	<div class="col-md-12">
		<form action="<?php echo $arResult['FORM_ACTION'] ?>" method="GET" class="form">
			<div class="form-group">
				<input type="text" name="cl_field" class="form-control" placeholder="Номер или ean13 клиента">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Отправить">
			</div>
		</form>
	</div>
	<?php if ($arResult['CLIENT_INFO']): ?>
		<div class="col-md-12">
			<?php foreach ($arResult['CLIENT_INFO']['info'] as $client): ?>
				<p class="alert alert-info"><?php echo $client ?></p>
			<?php endforeach ?>
		</div>
	<?php endif ?>
</div>






