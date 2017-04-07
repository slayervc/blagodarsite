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

	<section class="content-news">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
			<img
				class="detail_picture"
				border="0"
				src="<? echo $arResult["DETAIL_PICTURE"]["SRC"]?>"
				width="<? echo $arResult["DETAIL_PICTURE"]["WIDTH"]?>"
				height="<? echo $arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
				alt="<? echo $arResult["DETAIL_PICTURE"]["ALT"]?>"
				title="<? echo $arResult["DETAIL_PICTURE"]["TITLE"]?>"
				style="float: left;"
			/>
		<?endif?>

		<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
			<h1><?echo $arResult["NAME"]?></h1>
		<?endif;?>

		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N"):?>
			<p>
				<?echo $arResult["PREVIEW_TEXT"];?>
			</p>
		<?endif;?>

		<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
			<p class="txt-date">
				<?echo $arResult["DISPLAY_ACTIVE_FROM"]?>
			</p>
		<?endif?>

		<p>
			<?echo $arResult["DETAIL_TEXT"];?>
		</p>

	</section>
