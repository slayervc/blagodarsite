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
							<div class="header__logo-image-container">
								<img src="<?php echo SITE_TEMPLATE_PATH ?>/images/logo.png" alt="Комплекс-А">
							</div>
							<div class="header__logo-image-description">
								<span>УНИВЕРСАЛЬНАЯ БОНУСНАЯ СИСТЕМА</span>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 header__head-block">
						<div class="header__settings-fields">
						</div>
					</div>
					<div class="col-md-4 col-sm-4 header__head-block hidden-xs">
						<div class="header__auth-container header__auth-container--basic">
							<?php if ($USER->IsAuthorized()): ?>
								<div class="header__user-info">
									<span>Здравствуйте</span><br>
									<span><?php echo $USER->GetFullName() ?></span>
								</div>
								<a href="/auth/login.php?logout=yes&backurl=/" class="btn btn-default header__auth-button header__auth-button--expanded pull-right">Выйти</a>
							<?php else: ?>
							<a href="/auth/login.php" class="btn btn-default header__auth-button header__auth-button--first">Войти</a>
							<a href="/auth/register.php" class="btn btn-default header__auth-button">Зарегистрироваться</a>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="navigation">
			<div class="container">
				<div class="row">
					<div class="navbar-header">
						<button class="navbar-toggle navigation__nav-toggler" role="button" data-toggle="collapse" data-target=".navigation__nav-wrapper" aria-expanded="false">
							<span class="sr-only">Меню</span>
							<span class="icon-bar navigation__icon-bar"></span>
							<span class="icon-bar navigation__icon-bar"></span>
							<span class="icon-bar navigation__icon-bar"></span>
						</button>
					</div>
					<div class="navbar-collapse collapse navigation__nav-wrapper">
						<ul class="nav navbar-nav navigation__nav">
							<li>
								<a href="#" class="navigation__link navigation__link--icon-wrap navigation__link--active hidden-xs">
									<i class="navigation__icon"></i>
								</a>
							</li>
							<li><a href="#" class="navigation__link">Каталог предприятий</a></li>
							<li><a href="#" class="navigation__link">Акции</a></li>
							<li><a href="#" class="navigation__link">Рекомендации</a></li>
							<li><a href="#" class="navigation__link">Новости</a></li>
							<li><a href="#" class="navigation__link">О программе</a></li>
							<li><a href="#" class="navigation__link">Контакты</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
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
