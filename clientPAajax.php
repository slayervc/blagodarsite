<?php

class ClientPA{
    const CORE_URL = 'http://lk.blagodaryu.pro/api-client-personal-area';
    const CORE_REGISTER_URL = 'http://lk.blagodaryu.pro/api-register';

    public $login;
    public $token;

    private $apiKey = 'secret';   //Ключ для верификации отправителя POST запросов
    private $coreApiKey = 'LmddtsegY4e8tCRnWQBZ2BlTyuRZ70Pe';
    private $curl;


    public function __construct() {

        if ($this->curl = curl_init()) {
            //curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->curl, CURLOPT_POST, true);
        }
        else throw new LogicException('Can not init curl');

        $this -> execute();
    }

    //Вызывает метод, имя и параметры которого переданы POST запросом
    private function execute() {

        if (empty($_POST)){
            //$this -> response ('Empty request received', 400, false);
            return;
        }

        $args = array(
            'method' => FILTER_SANITIZE_STRING,
            'apikey' => FILTER_UNSAFE_RAW,
            'params' => array('filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_FORCE_ARRAY | FILTER_FLAG_NO_ENCODE_QUOTES)
        );

        $data = filter_input_array(INPUT_POST, $args);

        if ($data['apikey'] == $this -> apiKey) {
            $method = $data['method'];
            $params = count($data['params']) > 1 || is_array($data['params'][0]) ? $data['params'] : $data['params'][0];
            $params = $data['params'];

            if (method_exists($this, $method)) {
                $this->$method($params);
            }
            else{
                //$this -> response ('Invalid method name', 405, false);
            }
        }
        else{
            //$this -> response ('Invalid API key', 401, false);
            //$this -> response ('Invalid API key', 401, false);
        }
    }

    private function getLoginAndToken(){
        session_start();
        $this->login = $_SESSION['CLIENT_PA_LOGIN'];
        $this->token = $_SESSION['CLIENT_PA_TOKEN'];

        if (!$this->login || !$this->token) throw new LogicException('Can not get session data');
    }

    private function response($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function edit($client){
        $this->getLoginAndToken();

        $requestBody = http_build_query([
            'login' => $this->login,
            'token' => $this->token,
            'attributes' => $client
        ]);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL . '/edit');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        elseif ($statusCode == 401){
            $answer = ['code' => 401];
        }
        elseif ($statusCode == 422){
            $answer = ['code' => 422, 'message' => ''];
            $messages = json_decode($response, true);

            foreach ($messages as $field => $message){
                $answer['message'] .= '<p>' . $message . '</p>';
            }
        }
        else{
            $answer = ['code' => 500];
        }

        $this->response($answer);
    }

    public function changePassword($passwords){
        $this->getLoginAndToken();

        $passwords['login'] = $this->login;
        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL . '/change-password');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($passwords));

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = json_decode($response, true);
        }
        elseif ($statusCode == 401) {
            $answer = ['code' => 401];
        }
        else{
            $answer = ['code' => 500];
        }

        $this->response($answer);
    }

    public function saveRelations($relations){
        $this->getLoginAndToken();

        $requestBody = http_build_query([
            'login' => $this->login,
            'token' => $this->token,
            'relations' => $relations
        ]);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL . '/bonus-systems');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = ['code' => 200];
        }
        else{
            $answer = ['code' => $statusCode];
        }

        $this->response($answer);
    }

    public function getPartner($inn){
        $this->getLoginAndToken();

        $requestBody = http_build_query([
            'login' => $this->login,
            'token' => $this->token,
            'inn' => $inn
        ]);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL . '/get-partner');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        elseif ($statusCode == 401){
            $answer = ['code' => 401];
        }
        elseif ($statusCode == 404){
            $answer = ['code' => 404];
        }
        else{
            $answer = ['code' => 500];
        }

        $this->response($answer);
    }

    public function transaction($transaction){
        $this->getLoginAndToken();

        $requestBody = http_build_query([
            'login' => $this->login,
            'token' => $this->token,
            'amount' => $transaction['amount'],
            'partner' => $transaction['partner']
        ]);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL . '/transaction');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        elseif ($statusCode == 401){
            $answer = ['code' => 401];
        }
        elseif ($statusCode == 400){
            $message = json_decode($response, true);
            $answer = ['code' => 400];
            $answer['message'] = $message['message'];
        }
        elseif ($statusCode == 422){
            $answer = ['code' => 422, 'message' => ''];
            $messages = json_decode($response, true);

            foreach ($messages as $field => $message){
                $answer['message'] .= '<p>' . $message . '</p>';
            }
        }
        else{
            $answer = ['code' => 500];
        }

        $this->response($answer);
    }

    public function confirmTransaction($confirmation){
        $this->getLoginAndToken();

        $requestBody = http_build_query([
            'login' => $this->login,
            'token' => $this->token,
            'transaction' => $confirmation['transaction'],
            'code' => $confirmation['code']
        ]);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL . '/confirm');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        elseif ($statusCode == 401){
            $answer = ['code' => 401];
        }
        elseif ($statusCode == 400){
            $message = json_decode($response, true);
            $answer = ['code' => 400];
            $answer['message'] = $message['message'];
        }
        else{
            $answer = ['code' => 500];
        }

        $this->response($answer);
    }

    public function registerClient($client){
        $requestArray = [
            'apikey' => $this->coreApiKey,
            'siteCity' => $client['siteCity'],
        ];

        unset($client['siteCity']);
        $requestArray['Client'] = $client;
        $requestBody = http_build_query($requestArray);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_REGISTER_URL . '/register-client');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 201){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        elseif ($statusCode == 422){
            $answer = ['code' => 422, 'message' => ''];
            $messages = json_decode($response, true);

            foreach ($messages as $field => $message){
                $answer['message'] .= '<p>' . $message[0] . '</p>';
            }
        }
        elseif ($statusCode == 500){
            $answer = ['code' => 500,
                'data' => json_decode($response, true)
            ];
        }
        else{
            $message = json_decode($response, true);
            $answer = ['code' => $statusCode];
            $answer['message'] = $message['message'];
        }

        $this->response($answer);
    }

    public function confirmClient($data){
        $requestArray = [
            'apikey' => $this->coreApiKey,
            'code' => $data['code'],
            'client' => $data['client']
        ];

        $requestBody = http_build_query($requestArray);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_REGISTER_URL . '/confirm-client');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        else{
            $message = json_decode($response, true);
            $answer = ['code' => 500];
            $answer['message'] = $message['message'];
        }

        $this->response($answer);
    }

    public function retryClientConfirmation($client){
        $requestArray = [
            'apikey' => $this->coreApiKey,
            'client' => $client
        ];

        $requestBody = http_build_query($requestArray);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_REGISTER_URL . '/retry-client-confirmation');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        else{
            $message = json_decode($response, true);
            $answer = ['code' => 500];
            $answer['message'] = $message['message'];
        }

        $this->response($answer);
    }

    public function resetPassword($client){
        $requestArray = [
            'apikey' => $this->coreApiKey,
            'client' => $client
        ];

        $requestBody = http_build_query($requestArray);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_REGISTER_URL . '/reset-client-password');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        else{
            $message = json_decode($response, true);
            $answer = ['code' => 500];
            $answer['message'] = $message['message'];
        }

        $this->response($answer);
    }

    public function registerPartner($partner){
        $requestArray = [
            'apikey' => $this->coreApiKey,
            'siteCity' => $partner['siteCity'],
        ];

        unset($partner['siteCity']);
        $requestArray['Partner'] = $partner;
        $requestBody = http_build_query($requestArray);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_REGISTER_URL . '/register-partner');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        elseif ($statusCode == 422){
            $answer = ['code' => 422, 'message' => ''];
            $messages = json_decode($response, true);

            foreach ($messages as $field => $message){
                $answer['message'] .= '<p>' . $message[0] . '</p>';
            }
        }
        else{
            $message = json_decode($response, true);
            $answer = ['code' => $statusCode];
            $answer['message'] = $message['message'];
        }

        $this->response($answer);
    }

    public function resetPasswordRequest($phone){
        $requestArray = [
            'apikey' => $this->coreApiKey,
            'phone' => $phone
        ];

        $requestBody = http_build_query($requestArray);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_REGISTER_URL . '/reset-client-password-request');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        else{
            $message = json_decode($response, true);
            $answer = ['code' => 500];
            $answer['message'] = $message['message'];
        }

        $this->response($answer);
    }

    public function resetPasswordById($params){
        $requestArray = [
            'apikey' => $this->coreApiKey,
            'code' => $params['code'],
            'id' => $params['id']
        ];

        $requestBody = http_build_query($requestArray);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_REGISTER_URL . '/reset-client-password-by-code');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        else{
            $message = json_decode($response, true);
            $answer = ['code' => 500];
            $answer['message'] = $message['message'];
        }

        $this->response($answer);
    }

    public function lockCard($card){
        $this->getLoginAndToken();

        $requestBody = http_build_query([
            'login' => $this->login,
            'token' => $this->token,
            'card' => $card
        ]);

        curl_setopt($this->curl, CURLOPT_URL, self :: CORE_URL . '/lock-card');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($this->curl);
        $statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($statusCode == 200){
            $answer = [
                'code' => 200,
                'data' => json_decode($response, true)
            ];
        }
        else{
            $answer = ['code' => 500];
        }

        $this->response($answer);
    }

}

$clientPA = new clientPA();