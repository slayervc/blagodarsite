<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="col-md-12">
	<div class="company-list">
		<div class="row">
			<?
			$eachTwo = 0;
			$eachThree = 0;
			?>

			<? foreach ($arResult["ITEMS"] as $arItem): ?>

				<?
				$eachTwo ++;
				$eachThree ++;
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>

				<div class="col-md-4 col-sm-6 company-list__item">

					<? if ($arParams["DISPLAY_PICTURE"] != "N"): ?>

						<div class="company-list__image-wrapper">
							<div class="company-list__image">

								<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
									<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
								<? endif; ?>

								<? if (is_array($arItem["PREVIEW_PICTURE"])): ?>
									<img
										src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
										width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
										height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
										alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
										title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
									/>

								<? else: ?>
									<img src="/local/templates/blagodar/dist/images/no-image.jpg">
								<? endif; ?>

								<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
									</a>
								<? endif; ?>

							</div>
						</div>

					<? endif ?>

					<div class="company-list__content-wrapper">

						<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
							<h4 class="company-list__content-header">
								<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
									<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"
									   class="footer__col-news-header"><?echo str_replace('&amp;quot;', '"', $arItem["NAME"]); ?></a>
								<? else: ?>
									<b><? echo str_replace('&amp;quot;', '"', $arItem["NAME"]); ?></b><br/>
								<? endif; ?>
							</h4>
						<? endif; ?>

						<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
							<div class="company-list__content-main">
								<p><?echo $arItem["PREVIEW_TEXT"];?></p>
							</div>
						<? endif; ?>

					</div>
				</div>

				<?
				if ($eachTwo == 2) {
					echo ('<div class="clearfix visible-sm"></div>');
					$eachTwo = 0;
				}
				if ($eachThree == 3) {
					echo ('<div class="clearfix visible-md visible-lg"></div>');
					$eachThree = 0;
				}
				?>

			<? endforeach; ?>

		</div>
	</div>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>