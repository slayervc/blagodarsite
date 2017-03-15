<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('statistic');
CModule::IncludeModule('iblock');

class CitySelector
{
    const BLOCK_ID = 6, //Инфоблок "Города"
          DEFAULT_CITY = 568; //Иркутск

    public $currentCity = false;

    function SetCity($cityId){
        $cityList = CCity::GetList(
            false,
            array('CITY_ID' => $cityId)
        );

        $this -> currentCity = $cityList->Fetch();
        if (! $this -> currentCity) return;

        $cityList = CIBlockElement :: GetList(
            false,
            array("IBLOCK_ID" => self :: BLOCK_ID, 'PROPERTY_CITY_ID' => $cityId)
        );

        $city = $cityList -> GetNextElement();
        $properties = $city ? $city -> GetProperties() : false;
        $this -> currentCity['CORE_ID'] = $properties ? $properties['CORE_ID']['VALUE'] : false;
        $_SESSION['SESS_CURRENT_CITY'] = $this -> currentCity;
    }
}

$citySelector = new CitySelector();

if (!empty($_GET['set_city'])){ //Если был вызов из диалога выбора города
    $citySelector -> SetCity($_GET['set_city']);
}

//Если город уже выбран
if (! $citySelector -> currentCity && $_SESSION['SESS_CURRENT_CITY'] > 0){
    $citySelector -> currentCity = $_SESSION['SESS_CURRENT_CITY'];
}

//Если город не был выбран, но его удалось определить по IP
if (! $citySelector -> currentCity && $_SESSION['SESS_CITY_ID'] > 0){
    $citySelector -> SetCity($_SESSION['SESS_CITY_ID']);
}

//Если город никак не был установлен, устанавливаем город по дефолту
if (! $citySelector -> currentCity || ! $citySelector -> currentCity['CITY_NAME']){
    $citySelector -> SetCity(CitySelector :: DEFAULT_CITY);
}

$arResult['CURRENT_CITY'] = $citySelector -> currentCity['CITY_NAME'];
$this->IncludeComponentTemplate();