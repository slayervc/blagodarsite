<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test page");
?><br>
 <?

CModule::IncludeModule('statistic');
CModule::IncludeModule('iblock');

/*var_dump($_SESSION['SESS_CURRENT_CITY']);

if ($_SESSION['SESS_CITY_ID'] > 0)
{
	$cityList = CIBlockElement :: GetList(
		false,
		array("IBLOCK_ID" => '6', 'PROPERTY_CITY_ID' => $_SESSION['SESS_CITY_ID'])
	);

	$city = $cityList -> GetNextElement();
	$properties = $city -> GetProperties();
	var_dump($properties['CORE_ID']['VALUE']);
}

/*CModule::IncludeModule('statistic');

	$arOrder = array('REGION_NAME' => 'ASC');
	$arFilter = array('COUNTRY_ID' => 'RU');
	$cityList = CCity::GetList($arOrder, $arFilter);

	while ($city = $cityList->Fetch()) {
		var_dump($city);
	}*/

?><br>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>