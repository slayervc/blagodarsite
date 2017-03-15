<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$partnerCatalogFilter = array('PROPERTY_city' => $_SESSION['SESS_CURRENT_CITY']['CORE_ID']);

if ($_GET['catalog_search']){
    $partnerCatalogFilter[] = array(
        'LOGIC' => 'OR',
        'NAME' => '%' . $_GET['catalog_search'] . '%',
        'PREVIEW_TEXT' => '%' . $_GET['catalog_search'] . '%',
        'DETAIL_TEXT' => '%' . $_GET['catalog_search'] . '%'
    );

    $arResult['CATALOG_SEARCH_REQUEST'] = $_GET['catalog_search'];
}

$GLOBALS['PARTNER_CATALOG_FILTER'] = $partnerCatalogFilter;

$this->IncludeComponentTemplate();