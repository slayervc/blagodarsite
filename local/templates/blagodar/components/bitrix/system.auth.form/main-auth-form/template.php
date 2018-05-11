<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult['ERROR_MESSAGE']):?>
	<?php if (is_array($arResult['ERROR_MESSAGE']['MESSAGE'])): ?>
		<?php foreach ($arResult['ERROR_MESSAGE']['MESSAGE'] as $error): ?>
			<div class="alert alert-danger">
				<p class="text-center"><?php echo $error ?></p>
			</div>
		<?php endforeach ?>
	<?php else: ?>
		<div class="alert alert-danger">
			<p class="text-center"><?php echo $arResult['ERROR_MESSAGE']['MESSAGE'] ?></p>
		</div>
	<?php endif ?>
	
<? endif ?>

	<div class="auth-block__form">
		<a name="login"></a>
		<h4 class="auth-block__form-header text-center">
			Авторизация 
		</h4>
		<form name="system_auth_form<?=$arResult["RND"]?>" class="form" _taret="top" method="POST" action="<?php echo $arResult['AUTH_URL'] ?>">
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<?php if (!empty($arParams['CLIENT_TYPE'])): ?>
				<input type="hidden" name="CLIENT_TYPE" value="<?php echo $arParams['CLIENT_TYPE'] ?>">
			<?php endif ?>
			<div class="form-group">
				<input type="text" name="USER_LOGIN" class="form-control auth-block__form-control" placeholder="Логин">
			</div>
			<div class="form-group">
				<input type="password" name="USER_PASSWORD" autocomplete="off" class="form-control auth-block__form-control" placeholder="Пароль">
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<label for="CLIENT_TYPE">Клиент</label>
						<input type="radio" value="client" name="CLIENT_TYPE" checked="checked">
					</div>
					<div class="col-md-6 col-xs-6 text-right">
						<label for="CLIENT_TYPE">Партнер</label>
						<input type="radio" value="partner" name="CLIENT_TYPE">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 pull-right">
					<input type="submit" class="auth-block__button pull-right" name="Login" value="<?php echo GetMessage('AUTH_LOGIN_BUTTON') ?>">
				</div>
			</div>
		</form>
	</div>


