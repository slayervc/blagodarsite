<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php $APPLICATION->ShowTitle(); ?></title>
	<?php 
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/libs/jquery/dist/jquery.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/libs/bootstrap/dist/js/bootstrap.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/dist/js/script.js');
	?>
	<?php $APPLICATION->ShowHead(); ?>
	<link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH ?>/libs/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH ?>/dist/css/main.css">
	<link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH ?>/dist/css/additional.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>
	<header class="header">
		<div class="header__main">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 header__head-block">
						<a href="/" class="header__logo text-center">
							<img class="header__logo-picture" src="<?php echo SITE_TEMPLATE_PATH ?>/dist/images/logo.png" alt="Благодарю">
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-6 header__head-block  hidden-xs">
						<?

						$APPLICATION -> IncludeComponent(
							"evrysoft:external.city.select.form",
							".default",
							Array(
							),
							false
						);

						$commonCityFilter = $_SESSION['SESS_CURRENT_CITY']['BITRIX_ID'] ? Array('PROPERTY_city' => $_SESSION['SESS_CURRENT_CITY']['BITRIX_ID']) : false;

						?>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-6 header__head-block">
						<div class="header__auth-container header__auth-container--basic">
							<div><span>Личный кабинет</span></div>
							<?php if ($_SESSION['CLIENT_PA_TOKEN'] && $_SESSION['CLIENT_PA_LOGIN']): ?>
								<div class="header__user-info">
									<span>
										<a href="/auth/personal.php#top-nav"><?=$_SESSION['CLIENT_NAME']?></a>
									</span>
								</div>
								<a href="/auth/personal.php?out=1" class="btn btn-default header__auth-button header__auth-button--expanded pull-right">Выйти</a>
							<?php else: ?>
							<a href="/auth/personal.php#top-nav" class="btn btn-default header__auth-button header__auth-button--first">
								Вход
							</a>
							<a href="/auth/register.php#top-nav" class="btn btn-default header__auth-button">
								Регистрация
							</a>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a name="top-nav"></a>
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
					<?$APPLICATION->IncludeComponent(
						"bitrix:advertising.banner",
						"",
						Array(
							"CACHE_TIME" => "0",
							"CACHE_TYPE" => "A",
							"NOINDEX" => "N",
							"QUANTITY" => "1",
							"TYPE" => "TOP"
						)
					);?>
				</div>
			</div>
		</div>
		<div class="content-block">
		<div class="container">
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
        "START_FROM" => "0", 
        "PATH" => "", 
        "SITE_ID" => "s1" 
    )
);?>
			<div class="row">