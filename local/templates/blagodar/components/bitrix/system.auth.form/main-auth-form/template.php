<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']):?>
	<?php foreach ($arResult['ERROR_MESSAGE']['MESSAGE'] as $error): ?>
		<div class="alert alert-danger">
			<p class="text-center"><?php echo $error ?></p>
		</div>
	<?php endforeach ?>
<? endif ?>


<?php if ($arResult["FORM_TYPE"] == "login"): ?>
	<div class="auth-block__form">
		<h4 class="auth-block__form-header">
			Вход <?php if ($arParams['CLIENT_TYPE'] == 'Client'): ?>
				для Клиентов
				<?php elseif($arParams['CLIENT_TYPE'] == 'Partner'): ?>
				для Партнеров
				<?php endif ?>
		</h4>
		<form name="system_auth_form<?=$arResult["RND"]?>" class="form" _taret="top" method="POST" action="<?php echo $arResult['AUTH_URL'] ?>">

			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<input type="hidden" name="CLIENT_TYPE" value="<?php echo $arParams['CLIENT_TYPE'] ?>">
			<div class="form-group">
				<input type="text" name="USER_LOGIN" class="form-control auth-block__form-control" placeholder="Логин">
			</div>
			<div class="form-group">
				<input type="password" name="USER_PASSWORD" autocomplete="off" class="form-control auth-block__form-control" placeholder="Пароль">
			</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="auth-block__help-links">
						<a href="<?php echo $arResult['AUTH_REGISTER_URL'] ?>" class="auth-block__help-link">Регистрация</a>
						<a href="<?php echo $arResult['AUTH_FORGOT_PASSWORD_URL'] ?>" class="auth-block__help-link">Забыли пароль?</a>
					</div>
				</div>
				<div class="col-xs-6">
					<input type="submit" class="auth-block__button pull-right" name="Login" value="<?php echo GetMessage('AUTH_LOGIN_BUTTON') ?>">
				</div>
			</div>
		</form>
	</div>
<?php elseif ($arResult['FORM_TYPE'] == 'logout'):?>
	<div class="auth-block__form">
		<form class="form" action="<?=$arResult["AUTH_URL"]?>">
			<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="logout" value="yes" />
			<input type="submit" name="logout_butt" class="auth-block__button" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
		</form>
	</div>
<?endif?>
