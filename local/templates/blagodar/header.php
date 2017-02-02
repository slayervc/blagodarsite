<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php $APPLICATION->ShowTitle(); ?></title>
	<?php 
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/jquery/dist/jquery.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/bootstrap/dist/js/bootstrap.min.js');
	?>
	<?php $APPLICATION->ShowHead(); ?>
	<link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH ?>/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH ?>/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>
	<header class="header">
		<div class="header__main">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 header__head-block">
						<a href="/" class="header__logo">

								<img src="<?php echo SITE_TEMPLATE_PATH ?>/images/logo.png" alt="Комплекс-А">

						</a>
					</div>
					<div class="col-md-4 col-sm-4 header__head-block">
						<div class="header__settings-fields">
						</div>
					</div>
					<div class="col-md-4 col-sm-4 header__head-block">
						<div class="header__auth-container header__auth-container--basic">
							<?php if ($USER->IsAuthorized()): ?>
								<div class="header__user-info">
									<span>Здравствуйте</span><br>
									<span>
										<?php if ($USER->IsAdmin()): ?>
											<a href="<?php echo "/profile/partner" ?>"><?php echo $USER->GetFullName() ?></a>
										<?php else: ?>
											<a href="<?php echo "/profile/{$USER->GetParam('USER_API_TYPE')}" ?>"><?php echo $USER->GetFullName() ?></a>
										<?php endif ?>
									</span>
								</div>
								<a href="/auth/login.php?logout=yes&backurl=/" class="btn btn-default header__auth-button header__auth-button--expanded pull-right">Выйти</a>
							<?php else: ?>
							<a href="/auth/login.php" class="btn btn-default header__auth-button header__auth-button--first">
								Войти
							</a>
							<a href="/auth/register.php" class="btn btn-default header__auth-button">
								Зарегистрироваться
							</a>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"top",
			Array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "left",
				"DELAY" => "N",
				"MAX_LEVEL" => "1",
				"MENU_THEME" => "site",
				"ROOT_MENU_TYPE" => "top",
				"USE_EXT" => "N"
			)
		);?>
	</header>
	<main class="content">
		<div class="banner">
			<div class="container">
				<div class="row">
					<a href="#">
						<img src="<?php echo SITE_TEMPLATE_PATH ?>/images/banner.jpg">
					</a>
				</div>
			</div>
		</div>
		<div class="content-block">
		<div class="container">
			<div class="row">