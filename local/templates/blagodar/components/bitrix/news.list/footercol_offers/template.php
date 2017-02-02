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

$footercol_offersColors = ['#b9ffd0', '#f1ffb9', '#ffcc96'];
$footercol_offersCounter = -1;
?>

<?foreach($arResult["ITEMS"] as $arItem):?>

	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$footercol_offersCounter = $footercol_offersCounter >= count($footercol_offersColors) - 1 ? 0 : $footercol_offersCounter + 1;
	?>

	<div class="footer__col-content-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a href="#" class="footer__col-image-link" style="background: <?echo $footercol_offersColors[$footercol_offersCounter]?>">

			<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
				<div class="footer__col-image-link-block footer__col-image-link-block--image">

					<img
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					/>

				</div>
			<?endif?>

			<div class="footer__col-image-link-block footer__col-image-link-block--text">

				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
					<?echo $arItem["NAME"]?><br />
				<?endif;?>

				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<?echo $arItem["PREVIEW_TEXT"];?>
				<?endif;?>

			</div>
		</a>
	</div>

<?endforeach;?>

