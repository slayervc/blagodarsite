<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ClientPersonalArea
{
    const CORE_URL = 'http://lk.blagodaryu.pro/api-client-personal-area';

    private $curl;

    public $login;
    public $token;
    public $data;

    public function __construct()
    {
        $this->login = $_SESSION['CLIENT_PA_LOGIN'];
        $this->token = $_SESSION['CLIENT_PA_TOKEN'];

        if (!$this->login || !$this->token) throw new LogicException('Can not get session data');

        if ($this->curl = curl_init()) {
            //curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->curl, CURLOPT_POST, true);
        }
        else throw new LogicException('Can not init curl');
    }

    public function clearSession(){
        unset($_SESSION['CLIENT_PA_TOKEN']);
        unset($_SESSION['CLIENT_PA_LOGIN']);
    }

    public function getInformation(){
        $requestBody = http_build_query(['login' => $this->login, 'token' => $this->token]);
        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL . '/get-information');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);
        $response = curl_exec($this->curl);
        $response = json_decode($response, true);

        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $this->data = $response;
            return true;
        }
        elseif ($statusCode == 401){
            return 'Время сеанса истекло. Выполните вход повторно.';
        }
        else{
            return $response['message'] ? $response['message'] : 'Произошла непредвиденная ошибка';
        }
    }
}

$personalArea = new ClientPersonalArea();

$result = $personalArea->getInformation();

if ($result === true) {
    $_SESSION['CLIENT_NAME'] =$personalArea->data['client']['name'];
    $arResult['CLIENT_DATA'] = $personalArea->data['client'];
    $arResult['TRANSACTIONS'] = $personalArea->data['transactions'];
    $arResult['RELATIONS'] = $personalArea->data['relations'];
    $arResult['CARDS'] = $personalArea->data['cards'];
    $arResult['CORE_URL'] = ClientPersonalArea::CORE_URL;
} else {
    //$login = $_SESSION['CLIENT_PA_LOGIN'];
    $personalArea->clearSession();
    LocalRedirect("/auth/personal.php?&message=" . $result . '#top-nav');
}

$this->IncludeComponentTemplate();