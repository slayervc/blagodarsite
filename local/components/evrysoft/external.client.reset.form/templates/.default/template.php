<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if ($arResult['ERROR_MESSAGE']): ?>
	<div class="alert alert-danger">
		<p class="text-center"><?php echo $arResult['ERROR_MESSAGE'] ?></p>
	</div>
<? endif ?>

<div class="auth-block__form">
	<h4 class="auth-block__form-header text-center">
		Сброс пароля
	</h4>

    <p>
        Введите свой номер телефона и нажмите кнопку «Получить код». Вам будет отправлена СМС с кодом для сброса пароля.
    </p>

    <div id="registerFormMessage" class="alert alert-danger" style="display: none;"></div>

	<form name="client_reset_form" class="form" _taret="top">
		<div class="form-group">
			<input type="tel" id="phoneInput" class="form-control auth-block__form-control" placeholder="Номер телефона"
				   value="<?= $arResult['CLIENT_PHONE'] ?>">
            <input type="hidden" id="idInput">
		</div>
		<div class="form-group">
			<input type="number" id="codeInput" autocomplete="off" class="form-control auth-block__form-control"
				   placeholder="Код" style="display: none">
		</div>
		<div class="row">
            <div class="col-xs-3 pull-left">
                <input type="button" class="auth-block__button pull-left" id="resetButton" value="Сбросить пароль" onclick="resetPassword()" style="display: none">
            </div>

			<div class="col-xs-3 pull-right">
				<input type="button" class="auth-block__button pull-right" id="getCodeButton" value="Получить код" onclick="getCode()">
			</div>
		</div>
	</form>
</div>