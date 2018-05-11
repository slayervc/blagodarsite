<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if ($arResult['ERROR_MESSAGE']): ?>
	<div class="alert alert-danger">
		<p class="text-center"><?php echo $arResult['ERROR_MESSAGE'] ?></p>
	</div>
<? endif ?>

<div class="auth-block__form">
	<h4 class="auth-block__form-header text-center">
		Вход в личный кабинет
	</h4>
	<form name="client_login_form" class="form" _taret="top" method="POST"
		  action="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/auth/personal.php' ?>">
		<div class="form-group">
			<input type="tel" name="login" class="form-control auth-block__form-control" placeholder="Номер телефона"
				   value="<?= $arResult['CLIENT_LOGIN'] ?>">
		</div>
		<div class="form-group">
			<input type="password" name="password" autocomplete="off" class="form-control auth-block__form-control"
				   placeholder="Пароль">
		</div>
		<div class="row">
            <div class="col-xs-3 pull-left">
                <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/auth/personal.php?resetpassword=1' ?>">Забыли пароль?</a>
            </div>
			<div class="col-xs-3 pull-right">
				<input type="submit" class="auth-block__button pull-right" name="Login" value="Войти">
			</div>
		</div>
	</form>
</div>