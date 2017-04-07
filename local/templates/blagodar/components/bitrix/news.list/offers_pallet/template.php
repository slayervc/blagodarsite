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

	<div class="campaigns campaigns-news">
		<? foreach ($arResult["ITEMS"] as $arItem): ?>
			<div class="campaigns-item">

				<? if ($arParams["DISPLAY_PICTURE"] != "N"): ?>

								<? if (is_array($arItem["PREVIEW_PICTURE"])): ?>
									<a
										href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"
										class="campaigns-item__photo"
										style="background-image: url('<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>')"
									/></a>
								<? endif; ?>

				<? endif ?>

				<div class="campaigns-item__txt">

					<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
						<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>">
							<? echo $arItem["NAME"]; ?>
						</a>
					<? endif; ?>
					<p>
						<? echo $arItem["PREVIEW_TEXT"]; ?>
					</p>
				</div>

				<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
					<div class="campaigns-item__date">
						<?echo $arItem["DISPLAY_ACTIVE_FROM"]?>
					</div>
				<?endif?>

			</div>
		<? endforeach; ?>
	</div>
