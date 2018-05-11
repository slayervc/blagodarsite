<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><h2>О программе</h2>
<p>
	 Предлагаем Вам просмотреть небольшую видео-презентацию о на шей бонусной программе (если Вы не успеваете прочитать какой-то слайд, можно поставить видео на паузу :)). Также Вы можете ознакомиться со следующими документами:
</p>
<ul>
	<li><a href="/about/contract.php">Договор-оферта с клиентом</a></li>
	<li> <a href="/about/description.php">Правила Бонусной Системы</a></li>
</ul>
 <?$APPLICATION->IncludeComponent(
	"bitrix:player",
	"",
	Array(
		"ADVANCED_MODE_SETTINGS" => "N",
		"AUTOSTART" => "N",
		"HEIGHT" => "300",
		"MUTE" => "N",
		"PATH" => "/upload/medialibrary/1cf/1cfeeb52dbaa0a16f8ed323bbbadd32f.mp4",
		"PLAYBACK_RATE" => "1",
		"PLAYER_ID" => "",
		"PLAYER_TYPE" => "auto",
		"PRELOAD" => "N",
		"REPEAT" => "none",
		"SHOW_CONTROLS" => "Y",
		"SIZE_TYPE" => "fluid",
		"SKIN" => "",
		"SKIN_PATH" => "/bitrix/components/bitrix/player/videojs/skins",
		"START_TIME" => "0",
		"VOLUME" => "90",
		"WIDTH" => "400"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>