<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

class apiCatalog{

    const IBLOCK_ID = 6;
    const LOGO_IMG_DIR = '/upload/catalog/logos';
    const LOGO_BIG_IMG_DIR = '/upload/catalog/pictures';
    const LOGO_IMG_EXTENSIONS = 'jpg,jpeg,gif,png';

    private $apiKey = 'secret';   //Ключ для верификации отправителя POST запросов

    public static $logoImgSize = ['width' => 80, 'height' => 80];
    public static $logoBigImgSize = ['width' => 940, 'height' => 10000];
    public static $httpCodes = array (
        200 => '200 OK',
        204 => '204 No Content',
        400 => '400 Bad Request',
        401 => '401 Unauthorized',
        404 => '404 Not Found',
        405 => '405 Method Not Allowed',
        500 => '500 Internal Server Error');

    public function __construct() {
        $this -> execute();
    }

    //Вызывает метод, имя и параметры которого переданы POST запросом
    private function execute() {

        if (empty($_POST)){
            $this -> response ('Empty request received', 400, false);
            return;
        }

        $args = array(
            'method' => FILTER_SANITIZE_STRING,
            'apikey' => FILTER_UNSAFE_RAW,
            'params' => array('filter' => FILTER_DEFAULT,
                'flags'  => FILTER_FORCE_ARRAY/* | FILTER_FLAG_NO_ENCODE_QUOTES*/)
        );

        $data = filter_input_array(INPUT_POST, $args);

        if ($data['apikey'] == $this -> apiKey) {
            $method = $data['method'];
            //$params = count($data['params']) > 1 || is_array($data['params'][0]) ? $data['params'] : $data['params'][0];
            $params = $data['params'];

            if (method_exists($this, $method)) {
                $this->$method($params);
            }
            else{
                $this -> response ('Invalid method name', 405, false);
            }
        }
        else{
            $this -> response ('Invalid API key', 401, false);
        }
    }

    //Отвечает на AJAX запрос. $data - отправляемые данные, $code - HTTP код статуса, который будет отправлен,
    //$json = true, если следует отправить данные в формате JSON.
    private function response($data, $code = 200, $json = true) {

        if (array_key_exists($code, self :: $httpCodes)) header('HTTP/1.0 ' . self :: $httpCodes[$code]);
        if ($json) header('Content-Type: application/json');

        echo $json ? json_encode($data) : $data;
    }

    //Отшелушивает лишние данные Партнера, возвращаемый Битриксом
    private function preparePartnerData($data){
        unset(
            $data['IBLOCK_ID'],
            $data['SORT'],
            $data['DETAIL_TEXT_TYPE'],
            $data['PREVIEW_TEXT_TYPE']
        );

        foreach ($data as $key => $value){
            if (substr($key, 0, 1) == '~') unset($data[$key]);
        }

        foreach($data['PROPERTY_VALUES'] as $name => $property){
            $value = $property['VALUE'];

            if (is_array($value) && array_key_exists('TEXT', $value) && array_key_exists('TYPE', $value)){
                $value = htmlspecialchars_decode($value['TEXT']);
            }

            $data['PROPERTY_VALUES'][$name] = $value;
        }

        unset($data['PROPERTY_VALUES']['mainpage_order']);
        return $data;
    }

    private function getPartner($id){

        if (CModule::IncludeModule('iblock')) {

            $partnerSearch = CIBlockElement::GetList(
                Array("SORT"=>"ASC"),
                Array('IBLOCK_ID' => self::IBLOCK_ID, 'PROPERTY_partner_id' => $id),
                false,
                false,
                Array('ID' , 'IBLOCK_ID', 'NAME', 'IBLOCK_SECTION_ID', 'ACTIVE', 'PREVIEW_TEXT', 'DETAIL_TEXT')
            );

            $partner = $partnerSearch->GetNextElement();

            if ($partner){
                $result = $partner->GetFields();
                $result['PROPERTY_VALUES'] = $partner->GetProperties();
                $this->response($this->preparePartnerData($result));
            }
            else $this->response('Partner not found (id=' . $id . ')', 404, false);

        }
        else $this->response('Unable to include iblock module', 500, false);
    }

    private function getSections(){

        if (CModule::IncludeModule('iblock')) {

            $sections = CIBlockSection::GetList(
                Array("SORT" => "ASC"),
                ['IBLOCK_ID' => self::IBLOCK_ID, '<DEPTH_LEVEL' => 3],
                false,
                ['ID', 'IBLOCK_SECTION_ID', 'NAME']
            );

            $result = [];

            while($section = $sections->Fetch()){
                unset($section['SORT']);
                $result[] = $section;
            }

            $this->response($result);
        }
        else $this->response('Unable to include iblock module', 500, false);
    }

    //Добавляет партнера в инфоблок Битрикса. $partner - ассоциативный массив. Имена ключей должны совпадать с символьными
    //кодами свойств инфоблока. Возвращает id созданного партнера или текст сообщения ошибки.
    private function savePartner($partner)
    {
        if (CModule::IncludeModule("iblock")) {

            if ($_FILES['logo']){
                $filename = $_SERVER["DOCUMENT_ROOT"] . self :: LOGO_IMG_DIR . '/' . basename($_FILES['logo']['name']);
                move_uploaded_file($_FILES['logo']['tmp_name'], $filename);

                $resizedFile = $_SERVER["DOCUMENT_ROOT"] . self :: LOGO_IMG_DIR . '/resized/resized.jpg';
                CFile :: ResizeImageFile($filename, $resizedFile, self :: $logoImgSize, BX_RESIZE_IMAGE_PROPORTIONAL, false, 95, false);
                unlink($filename);
                $partner["PREVIEW_PICTURE"] = CFile::MakeFileArray($resizedFile);
            }

            if ($_FILES['logo_big']){
                $filename = $_SERVER["DOCUMENT_ROOT"] . self :: LOGO_BIG_IMG_DIR . '/' . basename($_FILES['logo_big']['name']);
                move_uploaded_file($_FILES['logo_big']['tmp_name'], $filename);

                $resizedBigFile = $_SERVER["DOCUMENT_ROOT"] . self :: LOGO_BIG_IMG_DIR . '/resized/resized.jpg';
                CFile :: ResizeImageFile($filename, $resizedBigFile, self :: $logoBigImgSize, BX_RESIZE_IMAGE_PROPORTIONAL, false, 95, false);
                unlink($filename);
                $partner["DETAIL_PICTURE"] = CFile::MakeFileArray($resizedBigFile);
            }

            $partner['IBLOCK_ID'] = self::IBLOCK_ID;
            $partnerElement = new CIBlockElement;

            //проверяем, существует ли создаваемый партнер
            $partnerList = CIBlockElement::GetList(Array(),
                Array("IBLOCK_ID" => self :: IBLOCK_ID, "PROPERTY_partner_id"=>$partner['PROPERTY_VALUES']['partner_id']));
            $oldPartner = $partnerList->GetNextElement();
            $partnerId = $oldPartner ? $oldPartner -> fields['ID'] : false;

            //Если партнер уже существует, читаем его свойства чтобы не потерялись при перезаписи
            if ($partnerId){
                $properties = $oldPartner -> GetProperties();

                if ($properties) {
                    $partner['PROPERTY_VALUES']['mainpage_order'] = $properties['mainpage_order']['VALUE'];
                    if (! array_key_exists('email', $partner['PROPERTY_VALUES'])) $partner['PROPERTY_VALUES']['email'] = $properties['email']['VALUE'];
                    if (! array_key_exists('address', $partner['PROPERTY_VALUES'])) $partner['PROPERTY_VALUES']['address'] = $properties['address']['VALUE'];
                    if (! array_key_exists('site', $partner['PROPERTY_VALUES'])) $partner['PROPERTY_VALUES']['site'] = $properties['site']['VALUE'];
                    if (! array_key_exists('city', $partner['PROPERTY_VALUES'])) $partner['PROPERTY_VALUES']['city'] = $properties['city']['VALUE'];
                    if (! array_key_exists('phone', $partner['PROPERTY_VALUES'])) $partner['PROPERTY_VALUES']['phone'] = $properties['phone']['VALUE'];
                }
            }

            $result = $partnerId ? $partnerElement->Update($partnerId, $partner) : $partnerElement->Add($partner);

            //$partnerElement->Update возвращает true при успехе. Заменим его на id обновленной категории.
            if ($result === true) $result = $partnerId;

            if ($result) $this->response(['id' => $result]);
            else $this->response($partnerElement->LAST_ERROR, 500 ,false);
        }
        else $this->response('Unable to include iblock module', 500, false);
    }

    private function deletePartner($partnerId)
    {
        if (CModule::IncludeModule("iblock"))
        {
            $partnerList = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => self :: IBLOCK_ID, "PROPERTY_partner_id" => $partnerId));
            $partner = $partnerList->GetNextElement();

            if (!$partner){
                $this->response('Partner not found (id=' . $partnerId . ')', 404, false);
                return;
            }

            CIBlockElement::Delete($partner->fields['ID']);
            $this->response('OK', 200, false);
        }
    }
}

ini_set('display_errors','Off');
$apiCatalog = new apiCatalog();