<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клонировать партнеров");

require($_SERVER["DOCUMENT_ROOT"]."/test/partner_import.php");

$partnerList = getPartnerList(1);
//$categoryList = getCategoryList();

//var_dump($partnerList, $categoryList);

foreach ($partnerList as $partner) {
    $result = addPartnerToInfoblock($partner);
    echo $result ? $result : 'Проблемы при подключении модуля инфоблоков.';
    echo '<BR>';
}

/*foreach ($categoryList as $category) {
    $result = addCategoryToInfoblock($category);
    echo $result ? $result : 'Проблемы при подключении модуля инфоблоков.';
    echo '<BR>';
}*/

?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>