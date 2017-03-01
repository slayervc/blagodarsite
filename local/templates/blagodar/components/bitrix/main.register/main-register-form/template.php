<?
/**
 * ShadowFiend Template for bitrix:main.register component
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<div class="container">
	<div class="row">
<?php if ($USER->IsAuthorized()): ?>
	<p><?php echo GetMessage("MAIN_REGISTER_AUTH") ?></p>
<?php else: ?>
<?
	if (count($arResult["ERRORS"]) > 0){
		foreach ($arResult["ERRORS"] as $key => $error)
			if (intval($key) == 0 && $key !== 0) {
				$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
			}
			echo '<p class="alert alert-danger">';
			echo implode("<br />", $arResult["ERRORS"]);
			echo '</p>';
	}
		
?>
		<div class="col-md-8 col-md-offset-2">
			<div class="auth-block">
				<h4 class="auth-block__form-header auth-block__form-header--centered">
					Регистрация
				</h4>
				<div class="auth-block__form auth-block__form--expanded auth-block__form--bordered">
					<form action="<?php echo POST_FORM_ACTION_URI ?>" method="POST" name="regform" class="form" enctype="multipart/form-data">
						<input type="hidden" 
							   name="user_type" 
							   value="<?php echo $arParams['CLIENT_TYPE'] ?>"
						>
						<?php foreach ($arResult['SHOW_FIELDS'] as $field): ?>
							
								<?php if ($arResult['REQUIRED_FIELDS_FLAGS'][$field] == 'Y'): ?>
									<!-- <span style="color:red">*</span> -->
								<?php endif ?>
								<?php if ($field == 'PASSWORD' || $field == 'CONFIRM_PASSWORD'): ?>
									<input type="hidden" 
										   name="REGISTER[<?php echo $field ?>]" 
										   placeholder="<?php echo strtolower(GetMessage('REGISTER_FIELD_'.$field)) ?>"
										   value="external_password"
									>
								<?php elseif ($field == 'LOGIN'):?>
									<input type="hidden" name="REGISTER[<?php echo $field ?>]" value="mobile_login">
								<?php elseif ($field == 'EMAIL'): ?>
								<div class="form-group">
									<input type="email" 
										   name="REGISTER[<?php echo $field ?>]" 
										   class="form-control auth-block__form-control" 
										   placeholder="<?php echo strtolower(GetMessage('REGISTER_FIELD_'.$field)) ?>"
									>
								</div>
								<?php else: ?>
								<div class="form-group">
									<input type="text" name="REGISTER[<?php echo $field ?>]" class="form-control auth-block__form-control" placeholder="<?php echo strtolower(GetMessage('REGISTER_FIELD_'.$field)) ?>">
								</div>
								<?php endif ?>
						<?php endforeach ?>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text" class="form-control auth-block__form-control" name="REGISTER[USER_PHONE_CODE]" placeholder="Код полученный из смс">
								</div>
								<div class="col-md-6">
									<button id="get_code_button" class="btn auth-block__button auth-block__button--full" data-get-code-url="http://<?php echo $_SERVER['HTTP_HOST'] ?>/code/auth/get">Получить код</button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<input type="date" class="form-control auth-block__form-control" name="REGISTER[BIRTH_DATE]" placeholder="Дата рождения (опционально)">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<input type="text" class="form-control auth-block__form-control" name="REGISTER[AGENT_CODE]" placeholder="Код агента (опционально)">
								</div>
							</div>
						</div>
						<input id="form-submit" type="submit" class="auth-block__button auth-block__button--full" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>">
					</form>
				</div>
			</div>
		</div>
<?php endif ?>
	</div>
</div>





