<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/code/auth/get#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/ext-pages/auth/get-auth-code.php",
	),
	array(
		"CONDITION" => "#^/campaigns/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/campaigns/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/offers/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/offers/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>