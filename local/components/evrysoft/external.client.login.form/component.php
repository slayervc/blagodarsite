<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//CModule::IncludeModule('statistic');
//CModule::IncludeModule('iblock');

class ClientLoginForm
{
    const CORE_URL = 'http://lk.blagodaryu.pro/api-client-personal-area/login';

    private $curl;
    public $token;
    public $client;

    public function __construct()
    {
        if ($this->curl = curl_init()) {
            //curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->curl, CURLOPT_POST, true);
            curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL);
        }
        else throw new LogicException('Can not init curl');
    }

    public function login($login, $password){
        $requestBody = http_build_query(['login' => $login, 'password' => $password]);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);
        $response = curl_exec($this->curl);
        $response = json_decode($response, true);

        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $this->token = $response['token'];
            $this->client = $response['client'];
            return true;
        }
        else{
            return $response['message'] ? $response['message'] : 'Произошла непредвиденная ошибка';
        }
    }
}

$loginForm = new ClientLoginForm();

$args = array(
    'login' => FILTER_UNSAFE_RAW,
    'password' => FILTER_UNSAFE_RAW
);

$credentials = filter_input_array(INPUT_POST, $args);

if ($credentials['login'] && $credentials['password'])
{

    $result = $loginForm->login($credentials['login'], $credentials['password']);

    if ($result === true) {
        $_SESSION['CLIENT_PA_TOKEN'] = $loginForm->token;
        $_SESSION['CLIENT_PA_LOGIN'] = $credentials['login'];
        $_SESSION['CLIENT_NAME'] = $loginForm->client['name'];
        LocalRedirect("/auth/personal.php#top-nav");
    } else {
        $arResult['ERROR_MESSAGE'] = $result;
        $arResult['CLIENT_LOGIN'] = $credentials['login'];
    }
}
else $arResult['CLIENT_LOGIN'] = $credentials['login'];

$this->IncludeComponentTemplate();