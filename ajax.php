<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (!empty($_POST["city_name"])){

    if (CModule::IncludeModule('statistic')) {
        $arOrder = array('REGION_NAME' => 'ASC', 'CITY_NAME' => 'ASC');
        $arFilter = array('CITY_NAME' => '%' . $_POST["city_name"] . '%');
        $cityList = CCity::GetList($arOrder, $arFilter);
        $cities = array();

        while ($city = $cityList->Fetch()) {
            $cities[] = $city;
        }

        echo json_encode($cities);
    }
}