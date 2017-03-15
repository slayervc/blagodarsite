<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клонировать партнеров");

require($_SERVER["DOCUMENT_ROOT"]."/test/partner_import.php");

$importer = new CatalogImporter();
//$importer -> UpdateCatalog();
var_dump($importer -> receiveCityList(false));
/*$partnerList = $importer -> getPartnerList(1);
$categoryList = $importer -> getCategoryList();
$cityList = $importer -> ReceiveCityList();
$hashes = $importer -> ReceiveHashes($cityList);
$importer -> SaveHashesToFile ($hashes);
$hashes = $importer -> LoadHashesFromFile();*/



//var_dump($hashes);
//var_dump($cityList);

/*foreach ($partnerList as $key => $partner) {
    $partnerList[$key] = $partner['partner_id'];
}*/

/*foreach ($categoryList as $category) {
    $result = $importer -> addCategoryToInfoblock($category);
    echo $result ? $result : 'Проблемы при подключении модуля инфоблоков.';
    echo '<BR>';
}*/

/*if (CModule::IncludeModule("iblock")) {
    $arFilter = Array("IBLOCK_ID" => 5, "PROPERTY_partner_id"=>10);
    $res = CIBlockElement::GetList(Array(), $arFilter);
    $ob = $res->GetNextElement();
    var_dump($ob -> fields['ID']);

    //$categoryEnums = CIBlockSection::GetList(array(),
      //  array("IBLOCK_ID" => 5, "UF_ID" => 9));

    //$categoryFields = $categoryEnums->GetNext();
    //var_dump($categoryFields);
}*/

unset($importer);

?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>