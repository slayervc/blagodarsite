<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("авторизация");
?>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php if (!$USER->IsAuthorized()): ?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.auth.form", 
					"main-auth-form", 
					array(
						"FORGOT_PASSWORD_URL" => "forgot-password.php",
						"PROFILE_URL" => "",
						"REGISTER_URL" => "",
						"SHOW_ERRORS" => "Y"
					),
					false
				);?>
			<?php else: ?>
				<p class="text-center">
					Вы уже авторизированы
				</p>
			<?php endif ?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>