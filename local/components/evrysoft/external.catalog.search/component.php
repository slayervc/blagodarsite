<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

const IBLOCK_CITIES = 5;   //ID инфоблока городов
const IBLOCK_PARTNERS = 6; //ID инфоблока Партнеры
$partnerCatalogFilter = [];

function getTree($id, &$categories){
    if (CModule::IncludeModule("iblock")) {

        $tree = CIBlockSection::GetList(
            Array("SORT"=>"ASC"),
            Array('IBLOCK_ID' => IBLOCK_PARTNERS, 'SECTION_ID' => $id),
            false,
            Array('ID')
        );

        $newCategories = [];

        while($section = $tree->Fetch()) {
            $newCategories[] = $section['ID'];
        }

        $categories = array_merge($categories, $newCategories);

        foreach ($newCategories as $category){
            getTree($category, $categories);
        }
    }
}

if (!$_GET['city']) // Если город не задан берем текущий город
    $partnerCatalogFilter['PROPERTY_city'] =$_SESSION['SESS_CURRENT_CITY']['BITRIX_ID'];
elseif ($_GET['city'] != 'all') {

    if (CModule::IncludeModule("iblock")) {

        $cityList = CIBlockElement:: GetList(
            false,
            array("IBLOCK_ID" => IBLOCK_CITIES, 'PROPERTY_CITY_ID' => $_GET['city'])
        );

        $city = $cityList->GetNextElement();
        if ($city) $partnerCatalogFilter['PROPERTY_city'] = $city->fields['ID'];
    }
}

if ($_GET['catalog_search']){
    $partnerCatalogFilter[] = array(
        'LOGIC' => 'OR',
        'NAME' => '%' . $_GET['catalog_search'] . '%',
        'PREVIEW_TEXT' => '%' . $_GET['catalog_search'] . '%',
        'DETAIL_TEXT' => '%' . $_GET['catalog_search'] . '%'
    );

    $arResult['CATALOG_SEARCH_REQUEST'] = $_GET['catalog_search'];
}

if ($_GET['phone']) {
    $partnerCatalogFilter['PROPERTY_phone'] = '%' . $_GET['phone'] . '%';
    $arResult['PHONE'] = $_GET['phone'];
}

if ($_GET['address']) {
    $partnerCatalogFilter['PROPERTY_address'] = '%' . $_GET['address'] . '%';
    $arResult['ADDRESS'] = $_GET['address'];
}

if (!empty($partnerCatalogFilter) && $_GET['SECTION_ID']){
    $categories = [];
    getTree($_GET['SECTION_ID'], $categories);
    $categories[] = $_GET['SECTION_ID'];
    $partnerCatalogFilter['IBLOCK_SECTION_ID'] = $categories;
}


if (CModule::IncludeModule("iblock")) {

    $arResult['CATEGORY_LIST'] = [];
    $tree = CIBlockSection::GetTreeList(
        Array('IBLOCK_ID' => 6, '<=DEPTH_LEVEL' => 2),
        Array('ID', 'NAME', 'DEPTH_LEVEL')
    );

    while($section = $tree->Fetch()) {
        $arResult['CATEGORY_LIST'][] = $section;
    }
}

if (CModule::IncludeModule('statistic')){
    $arResult['CITY_LIST'] = [];
    $lastRegion = '';
    $cities = CCity::GetList(['REGION_NAME' => 'ASC'], ['COUNTRY_ID' => 'RU']);

    while ($city = $cities->Fetch()) {
        if (!$city['CITY_NAME']) continue;
        $arResult['CITY_LIST'][$city['REGION_NAME']][] = $city;
    }
}

$GLOBALS['PARTNER_CATALOG_FILTER'] = $partnerCatalogFilter;

$this->IncludeComponentTemplate();