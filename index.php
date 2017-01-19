<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?>

<div class="container">
	<div class="row">
		 <?php if (!$USER->IsAuthorized()): ?>
		<div class="col-md-12">
			<div class="auth-block">
				<div class="row">
					<div class="col-md-6">
						 <?$APPLICATION->IncludeComponent(
							"bitrix:system.auth.form",
							"main-auth-form",
							Array(
								"CLIENT_TYPE" => "Partner",
								"FORGOT_PASSWORD_URL" => "auth/forgot-password.php",
								"PROFILE_URL" => "profile/client/",
								"REGISTER_URL" => "/auth/register.php",
								"SHOW_ERRORS" => "Y"
							)
						);?>
					</div>
					<div class="col-md-6">
						 <?$APPLICATION->IncludeComponent(
							"bitrix:system.auth.form",
							"main-auth-form",
							Array(
								"CLIENT_TYPE" => "Client",
								"FORGOT_PASSWORD_URL" => "/auth/forgot-password.php",
								"PROFILE_URL" => "profile/partner/",
								"REGISTER_URL" => "/auth/register.php",
								"SHOW_ERRORS" => "Y"
							)
						);?>
					</div>
				</div>
			</div>
		</div>
		<?php else: ?>
			<?php 
				$APPLICATION->IncludeComponent(
					'evrysoft:external.user.info',
					'',
					Array(
						"URI" => ''
					)
				);
			?>
		<?php endif ?>
		<div class="col-md-12">
			<div class="company-search">
				<div class="row">
					<div class="col-md-3 company-search__column">
						<div class="company-search__name-badge">
							 Каталог компаний
						</div>
					</div>
					<div class="col-md-6 col-xs-8 company-search__column">
						<div class="company-search__input-wrapper">
 <input type="text" class="company-search__input" placeholder="Введите назавние компании или вид деятельности">
						</div>
					</div>
					<div class="col-md-3 col-xs-4 company-search__column">
 <button class="company-search__search-button pull-right">
						Найти </button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="company-list">
				<div class="row">
				<?php for ($i=0; $i < 9; $i++):?>
					<div class="col-md-4 col-sm-6 company-list__item">
						<div class="company-list__image-wrapper">
							<div class="company-list__image">
									<img alt="company image" src="http://placehold.it/200x200">
							</div>
						</div>
						<div class="company-list__content-wrapper">
							<h4 class="company-list__content-header"> <a href="#">Company header</a> </h4>
							<div class="company-list__content-main">
								<p>
									 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, dolore?
								</p>
							</div>
						</div>
					</div>
				<?php endfor ?>
				</div>
			</div>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>