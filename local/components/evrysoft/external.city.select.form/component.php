<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('statistic');
CModule::IncludeModule('iblock');

class CitySelector
{
    private static $instance;

    const BLOCK_ID = 6, //Инфоблок "Города"
        DEFAULT_CITY = 568; //Иркутск

    public $currentCity = false;

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    public static function getInstance(){

        if (empty(self :: $instance)){
            self :: $instance = new self();
        }

        return self :: $instance;
    }

    function setCity($cityId){
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

        if ($city) {
            $properties = $city->GetProperties();
            $this -> currentCity['CORE_ID'] = $properties ? $properties['CORE_ID']['VALUE'] : false;
            $this -> currentCity['BITRIX_ID'] = $city -> fields['ID'];
        }

        $_SESSION['SESS_CURRENT_CITY'] = $this -> currentCity;
    }
}

$citySelector = CitySelector :: getInstance();

if (!empty($_GET['set_city'])){ //Если был вызов из диалога выбора города
    $citySelector -> setCity($_GET['set_city']);
}

//Если город уже выбран
if (! $citySelector -> currentCity && $_SESSION['SESS_CURRENT_CITY'] > 0){
    $citySelector -> currentCity = $_SESSION['SESS_CURRENT_CITY'];
}

//Если город не был выбран, но его удалось определить по IP
if (! $citySelector -> currentCity && $_SESSION['SESS_CITY_ID'] > 0){
    $citySelector -> setCity($_SESSION['SESS_CITY_ID']);
}

//Если город никак не был установлен, устанавливаем город по дефолту
if (! $citySelector -> currentCity || ! $citySelector -> currentCity['CITY_NAME']){
    $citySelector -> setCity(CitySelector :: DEFAULT_CITY);
}

//$commonCityFilter = $citySelector -> currentCity['BITRIX_ID'] ? Array('PROPERTY_city' => currentCity['BITRIX_ID']) : false;

$arResult['CURRENT_CITY'] = $citySelector -> currentCity['CITY_NAME'];
$this->IncludeComponentTemplate();