<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("регистрация");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/submit-to-api.js");
?>

<? $APPLICATION->IncludeComponent(
	"evrysoft:external.register.form",
	"",
	array()
); ?>

<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"main-register-form", 
	array(
		"AUTH" => "N",
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "SECOND_NAME",
			3 => "LAST_NAME",
			4 => "PERSONAL_MOBILE",
		),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "SECOND_NAME",
			3 => "LAST_NAME",
			4 => "PERSONAL_MOBILE",
		),
		"SUCCESS_PAGE" => "/index.php",
		"USE_BACKURL" => "N",
		"COMPONENT_TEMPLATE" => "main-register-form",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => "",
		"CLIENT_TYPE" => "Client"
	),
	false
);*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

