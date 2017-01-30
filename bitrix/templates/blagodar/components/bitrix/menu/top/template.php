<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

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
						<a href="/" class="navigation__link navigation__link--icon-wrap navigation__link--active hidden-xs">
							<i class="navigation__icon"></i>
						</a>
					</li>

					<?foreach($arResult as $arItem):?>
						<?if ($arItem["PERMISSION"] > "D"):?>
							<li><a href="<?=$arItem["LINK"]?>" class="navigation__link"><nobr><?=$arItem["TEXT"]?></nobr></a></li>
						<?endif?>
					<?endforeach?>

				</ul>
			</div>
		</div>
	</div>
</nav>

<?endif?>