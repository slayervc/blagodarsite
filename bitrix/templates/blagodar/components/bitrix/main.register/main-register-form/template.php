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
<?php if ($arResult['ERRORS']): ?>
	<pre>
		<?php var_dump($arResult['ERRORS']) ?>
	</pre>
<?php endif ?>

		<div class="col-md-8 col-md-offset-2">
			<div class="auth-block">
				<h4 class="auth-block__form-header auth-block__form-header--centered">
					Регистрация
				</h4>
				<div class="auth-block__form auth-block__form--expanded auth-block__form--bordered">
					<form action="<?php echo POST_FORM_ACTION_URI ?>" method="POST" name="regform" class="form" enctype="multipart/form-data">
						<input type="hidden" name="user_type" value="client">
						<?php foreach ($arResult['SHOW_FIELDS'] as $field): ?>
							<div class="form-group">
								<?php if ($arResult['REQUIRED_FIELDS_FLAGS'][$field] == 'Y'): ?>
									<span style="color:red">*</span>
								<?php endif ?>
								<?php if ($field == 'PASSWORD' || $field == 'CONFIRM_PASSWORD'): ?>
									<input type="password" name="REGISTER[<?php echo $field ?>]" class="form-control auth-block__form-control" placeholder="<?php echo strtolower($field) ?>">
								<?php elseif ($field == 'EMAIL'): ?>
									<input type="email" name="REGISTER[<?php echo $field ?>]" class="form-control auth-block__form-control" placeholder="<?php echo strtolower($field) ?>">
								<?php else: ?>
									<input type="text" name="REGISTER[<?php echo $field ?>]" class="form-control auth-block__form-control" placeholder="<?php echo strtolower($field) ?>">
								<?php endif ?>
							</div>
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
						<input id="form-submit" type="submit" class="auth-block__button auth-block__button--full" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>">
					</form>
				</div>
			</div>
		</div>
<?php endif ?>
	</div>
</div>





