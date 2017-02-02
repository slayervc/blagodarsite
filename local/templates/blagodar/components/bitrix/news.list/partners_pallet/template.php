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

			<? foreach ($arResult["ITEMS"] as $arItem): ?>

				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>

				<div class="col-md-4 col-sm-6 company-list__item">

					<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>

						<div class="company-list__image-wrapper">
							<div class="company-list__image">

								<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
									<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img
											src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
											width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
											height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
											alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
											title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
										/></a>
								<? else: ?>
									<img
										src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
										width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
										height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
										alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
										title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
									/>
								<? endif; ?>

							</div>
						</div>

					<? endif ?>

					<div class="company-list__content-wrapper">

						<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
							<h4 class="company-list__content-header">
								<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
									<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"
									   class="footer__col-news-header"><? echo $arItem["NAME"] ?></a>
								<? else: ?>
									<b><? echo $arItem["NAME"] ?></b><br/>
								<? endif; ?>
							</h4>
						<? endif; ?>

						<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
							<div class="company-list__content-main">
								<p><? echo $arItem["PREVIEW_TEXT"]; ?></p>
							</div>
						<? endif; ?>

					</div>
				</div>

			<? endforeach; ?>

		</div>
	</div>
</div>