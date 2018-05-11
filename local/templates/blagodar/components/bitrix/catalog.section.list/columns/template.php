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

$strTitle = "";
?>

<div class="categories">
<?
	foreach($arResult["SECTIONS"] as $arSection){
		$count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "<span>".$arSection["ELEMENT_CNT"]."</span>" : "";
		echo '<div class="categories__item"><a href="'.$arSection["SECTION_PAGE_URL"] .
			'">' . $arSection["NAME"] . '</a>' . $count . '</div>';
	}
?>
</div>

<?=($strTitle?'<br/><h2>'.$strTitle.'</h2>':'')?>
