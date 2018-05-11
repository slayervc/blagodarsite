<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('statistic');
CModule::IncludeModule('iblock');

class CitySelector extends CBitrixComponent
{
    //private static $instance;

    const BLOCK_ID = 5, //Инфоблок "Города"
        DEFAULT_CITY = 570; //Иркутск

    public $currentCity = false;

    //private function __construct(){}
    //private function __clone(){}
    //private function __wakeup(){}

    public function executeComponent(){
        //$this = CitySelector :: getInstance();

        if (!empty($_GET['set_city'])){ //Если был вызов из диалога выбора города
            $this -> setCity($_GET['set_city']);
        }

        //Если город уже выбран
        if (! $this -> currentCity && $_SESSION['SESS_CURRENT_CITY'] > 0){
            $this -> currentCity = $_SESSION['SESS_CURRENT_CITY'];
        }

        //Если город не был выбран, но его удалось определить по IP
        if (! $this -> currentCity && $_SESSION['SESS_CITY_ID'] > 0){
            $this -> setCity($_SESSION['SESS_CITY_ID']);
        }

        //Если город никак не был установлен, устанавливаем город по дефолту
        if (! $this -> currentCity || ! $this -> currentCity['CITY_NAME']){
            $this -> setCity(CitySelector :: DEFAULT_CITY);
        }

        //$commonCityFilter = $this -> currentCity['BITRIX_ID'] ? Array('PROPERTY_city' => currentCity['BITRIX_ID']) : false;

        $this->arResult['CURRENT_CITY'] = $this -> currentCity['CITY_NAME'];
        $this->IncludeComponentTemplate();
    }

    /*public static function getInstance(){

        if (empty(self :: $instance)){
            self :: $instance = new self();
        }

        return self :: $instance;
    }*/

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