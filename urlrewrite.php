<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/stssync/calendar/#",
		"RULE" => "",
		"ID" => "bitrix:stssync.server",
		"PATH" => "/bitrix/services/stssync/calendar/index.php",
	),
	array(
		"CONDITION" => "#^/code/auth/get#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/ext-pages/auth/get-auth-code.php",
	),
);

?>