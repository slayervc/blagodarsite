<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Add element");
?>

<?
if(CModule::IncludeModule("iblock")) {

  $el = new CIBlockElement;

  $PROP = array();
  $PROP['core_id'] = 55;
  $PROP['email'] = 'api@yocommon.ru';
  $PROP['address'] = 'ул. Апишная, 432';
  $PROP['site'] = 'http://apiisgood.com';
  $PROP['city_coreid'] = 38;
  $PROP['city_name'] = 'Иркутск';
  $PROP['phone'] = '(3952) 33-43-65';
  $PROP['holding_coreid'] = 45;
  $PROP['holding_name'] = 'Корпорация API';

  $arLoadProductArray = Array(
      "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
      "IBLOCK_ID" => 11,
      "PROPERTY_VALUES"=> $PROP,
      "NAME" => "Еще из API",
      "ACTIVE" => "Y",            // активен
      "PREVIEW_TEXT" => "Превью",
      "DETAIL_TEXT" => "Детальное описание"
    //"DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
  );

  if ($PRODUCT_ID = $el->Add($arLoadProductArray))
    echo "New ID: " . $PRODUCT_ID;
  else
    echo "Error: " . $el->LAST_ERROR;
}
else
{
  echo "Модуль не установлен";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>