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
//$arResult["PREVIEW_PICTURE"]
?>

<section class="content-news">

    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
        <img
                class="detail_picture"
                border="0"
                src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
        />
    <?endif?>

	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h1><?=$arResult["NAME"]?></h1>
	<?endif;?>

    <p>
	    <?echo $arResult["DETAIL_TEXT"];//echo str_replace(chr(13), '<BR>', $arResult["PREVIEW_TEXT"]);?>
    </p>

	<div class="content-news__contact">
		<!--div class="row"-->
			<!--div class="col-sm-4"-->
				<!--h3>
					Контактная информация:
				</h3-->

				<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
				<p>
				<b><?=$arProperty["NAME"]?>:</b>
				<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
					<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
				<?else:?>
					<?
                        $displayText = $arProperty["DISPLAY_VALUE"];

                        if ($pid == 'site' && mb_stripos($displayText, 'http') === false){
                            $displayText = '<a href="http://' . $displayText . '" target="blank">' . $displayText . '</a>';
                        }

                        //if ($pid == 'address') echo('<BR><BR>');

                        //echo str_replace(chr(13), '<BR>', $displayText);
                        echo $displayText;
                    ?>
				<?endif?>
				</p>
				<?endforeach?>
			<!--/div-->
			<!--div class="col-sm-8">
				<h3>
					Карта:
				</h3>

				<div class="content-news__map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d287426.52495969186!2d37.352325873552346!3d55.74947333104615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54afc73d4b0c9%3A0x3d44d6cc5757cf4c!2z0JzQvtGB0LrQstCw!5e0!3m2!1sru!2sru!4v1490655752642" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div-->
		<!--/div-->
	</div>
</section>