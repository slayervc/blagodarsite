<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<nav class="navigation">
	<div class="container">
		<div class="row">
			<div class="navbar-header">
				<div class="pull-left hidden-lg hidden-md hidden-sm">
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
				<button class="navbar-toggle navigation__nav-toggler" role="button" data-toggle="collapse" data-target=".navigation__nav-wrapper" aria-expanded="false">
					<span class="sr-only">Меню</span>
					<span class="navigation__link">Меню</span>
					<!--<span class="icon-bar navigation__icon-bar"></span>
					<span class="icon-bar navigation__icon-bar"></span>
					<span class="icon-bar navigation__icon-bar"></span>-->
				</button>
			</div>
			<div class="navbar-collapse collapse navigation__nav-wrapper">
				<ul class="nav navbar-nav navigation__nav">
					<?foreach($arResult as $arItem):?>
						<?if ($arItem["PERMISSION"] > "D"):?>
							<?php if ($arItem['LINK'] == '/'): ?>
								<li>
									<a href="/" class="navigation__link 
										navigation__link--icon-wrap 
										hidden-xs
										<?php if ($arItem['SELECTED']): ?>
											navigation__link--active
										<?php endif ?>"
									>
										<i class="navigation__icon"></i>
									</a>
								</li>
							<?php else: ?>
							<li>
								<a href="<?=$arItem["LINK"]?>" 
								   class="navigation__link
									<?php if ($arItem['SELECTED']): ?>
										navigation__link--active
									<?php endif ?>
								">
									<?=$arItem["TEXT"]?>
								</a>
							</li>
							<?php endif ?>
						<?endif?>
					<?endforeach?>
				</ul>
			</div>
		</div>
	</div>
</nav>

<?endif?>