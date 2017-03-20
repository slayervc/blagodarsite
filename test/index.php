<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test page");
?><br>
 <?

CModule::IncludeModule('statistic');
CModule::IncludeModule('iblock');

$APPLICATION -> IncludeComponent(
    "evrysoft:external.city.select.form",
    ".default",
    Array(
    ),
    false
);

?><br>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>