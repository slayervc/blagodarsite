<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

	<div class="row">
		<ul class="footer__links-menu">
			<?foreach($arResult as $arItem):?>
				<?if ($arItem["PERMISSION"] > "D"):?>
					<li class="footer__link-item"><a href="<?=$arItem["LINK"]?>" class="footer__link"><nobr><?=$arItem["TEXT"]?></nobr></a></li>
				<?endif?>
			<?endforeach?>
		</ul>
	</div>

<?endif?>