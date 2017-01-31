<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
	$error = $APPLICATION->GetException();
?>
<?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']):?>
	<?php foreach ($arResult['ERROR_MESSAGE']['MESSAGE'] as $error): ?>
		<div class="alert alert-danger">
			<p class="text-center"><?php echo $error ?></p>
		</div>
	<?php endforeach ?>
<? endif ?>

	<div class="auth-block__form">
		<h4 class="auth-block__form-header">
			Авторизация
		</h4>
		<form name="system_auth_form<?=$arResult["RND"]?>" class="form" _taret="top" method="POST" action="<?php echo $arResult['AUTH_URL'] ?>">

			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<div class="form-group">
				<input type="text" name="USER_LOGIN" class="form-control auth-block__form-control" placeholder="Логин">
			</div>
			<div class="form-group">
				<input type="password" name="USER_PASSWORD" autocomplete="off" class="form-control auth-block__form-control" placeholder="Пароль">
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="CLIENT_TYPE">Партнер</label>
						<input type="radio" name="CLIENT_TYPE" value="partner">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="CLIENT_TYPE">Клиент</label>
						<input type="radio" name="CLIENT_TYPE" value="client">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="auth-block__help-links">
						<a href="<?php echo $arResult['AUTH_REGISTER_URL'] ?>" class="auth-block__help-link">Регистрация</a>
						<a href="<?php echo $arResult['AUTH_FORGOT_PASSWORD_URL'] ?>" class="auth-block__help-link">Забыли пароль?</a>
					</div>
				</div>
				<div class="col-xs-6">
					<input type="submit" class="auth-block__button pull-right" name="Login" value="Войти">
				</div>
			</div>
		</form>
	</div>

