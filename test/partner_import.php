<?php

class CatalogImporter
{

    const SERVER_URL = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1',
          SERVER_LOGIN = 'SYSTEM',
          SERVER_PASSWORD = '94jc09ePOnbedw',
          BLOCK_ID = 5, //Инфоблок "Партнеры"
          HASH_FILE = '/upload/catalog/hash.json',
          LOG_FILE = '/upload/catalog/import.log',
          LOGO_IMG_DIR = '/upload/catalog/logos',
          LOGO_IMG_EXTENSIONS = 'jpg,jpeg,gif,png';

    static $logoImgSize = ['width' => 80, 'height' => 80];
    private $curl;

    function __construct()
    {
        //Авторизуемся в ядре, Получаем токен доступа
        if ($this->curl = curl_init()) {
            $authRequest = ["login" => self :: SERVER_LOGIN, "password" => self :: SERVER_PASSWORD];

            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->curl, CURLOPT_POST, true);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $authRequest);
            curl_setopt($this->curl, CURLOPT_URL, self :: SERVER_URL . '/adm/tokens?type=json');

            $token = curl_exec($this->curl);
            $token = $token ? json_decode($token)->info->token : false;

            if ($token) {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, ['token' => $token]);
                return;
            }
        }

        //Если токен получить не удалось, генерируем исключение
        throw new LogicException('Can not receive auth token');
    }

    function __desstruct()
    {
        curl_close($this->curl);
    }

    private function log($message){
        $message = date("m.d.y H:i:s") . '   ' . $message . PHP_EOL;
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . self :: LOG_FILE, $message, FILE_APPEND);
    }

    //Запрашивает из ядра каталог партнеров. Возвращает массив ассоциативных массивов или false
    public function getPartnerList($city)
    {
        curl_setopt($this->curl, CURLOPT_URL, self :: SERVER_URL . '/adm/partners/getcatalog?type=json&no_groups=true&city_id=' . $city);
        $out = curl_exec($this->curl);
        $out = json_decode($out, true);
        return $out ? $out['info']['list'] : false;
    }

    //Запрашивает из ядра категории каталога партнеров. Возвращает массив ассоциативных массивов или false.
    public function getCategoryList()
    {
        curl_setopt($this->curl, CURLOPT_URL, self :: SERVER_URL . '/adm/categories/getlist?type=json');
        $out = curl_exec($this->curl);
        $out = json_decode($out, true);
        return $out ? $out['info']['list'] : false;
    }

    //Подготавливает запись каталога партнеров $partner, полученную из ядра, к сохранению в инфоблоке Битрикса.
    private static function preparePartnerValues(&$partner)
    {
        //Преобразуем значение свойства "вид клиента" в id списка

        if (array_key_exists('type', $partner)) {

            $propertyEnums = CIBlockPropertyEnum::GetList(array(),
                array("IBLOCK_ID" => self :: BLOCK_ID, "CODE" => "type", "EXTERNAL_ID" => 'id' . $partner['type']));

            if ($enum_fields = $propertyEnums->GetNext()) {
                $partner['type'] = $enum_fields['ID'];
                return true;
            }

            $partner['type'] = null;
            return false;
        }

        return false;
    }

    //Добавляет партнера в инфоблок Битрикса. $partner - ассоциативный массив. Имена ключей должны совпадать с символьными
    //кодами свойств инфоблока. Возвращает id созданного партнера или текст сообщения ошибки.
    public function addPartnerToInfoblock($partner, $rewrite = true)
    {
        if (CModule::IncludeModule("iblock")) {
            self :: preparePartnerValues($partner);

            //Получаем id категории битрикса из id категории ядра
            $categoryList = CIBlockSection::GetList(array(),
                array("IBLOCK_ID" => self :: BLOCK_ID, "UF_ID" => $partner['category_id']));
            $category = $categoryList -> GetNext();
            $sectionId = $category ? $category['ID'] : false;

            $partnerElement = new CIBlockElement;
            $partnerFields = Array(
                "IBLOCK_SECTION_ID" => $sectionId,
                "IBLOCK_ID" => self :: BLOCK_ID,
                "PROPERTY_VALUES" => $partner,
                "NAME" => $partner['partner_name'],
                "ACTIVE" => "Y",
                "PREVIEW_TEXT" => $partner['partner_info']
            );

            //Пробуем получить логотип из файла
            $logoFile = $this -> getPartnerLogo($partner['partner_id']);
            if ($logoFile) $partnerFields["PREVIEW_PICTURE"] = $logoFile;

            //проверяем, существует ли создаваемый партнер
            $partnerList = CIBlockElement::GetList(Array(),
                Array("IBLOCK_ID" => self :: BLOCK_ID, "PROPERTY_partner_id"=>$partner['partner_id']));
            $oldPartner = $partnerList->GetNextElement();
            $partnerId = $oldPartner ? $oldPartner -> fields['ID'] : false;

            //Если партнер уже существует, читаем его свойство "порядок вывода на главной", чтобы не потерялось при перезаписи
            if ($partnerId){
                $properties = $oldPartner -> GetProperties();
                if ($properties) $partnerFields['PROPERTY_VALUES']['mainpage_order'] = $properties['mainpage_order']['VALUE'];
            }

            $result = $partnerId ? $partnerElement->Update($partnerId, $partnerFields) : $partnerElement->Add($partnerFields);
            //$partnerElement->Update возвращает true при успехе. Заменим его на id обновленной категории.
            if ($result === true) $result = $partnerId;
            return $result ? $result : $partnerElement->LAST_ERROR;
        }

        return false;
    }

    //Добавляет категорию каталога партнеров в инфоблок Битрикса. $category - ассоциативный массив. Имена ключей приводятся
    //к формату названий пользовательских полей битрикса. Возвращает id созданной или обновленной категории или текст сообщения ошибки.
    public function addCategoryToInfoblock($category)
    {

        if (CModule::IncludeModule("iblock")) {
            $categoryElement = new CIBlockSection;

            $fields = ["ACTIVE" => 'Y',
                "IBLOCK_SECTION_ID" => false,
                "IBLOCK_ID" => self :: BLOCK_ID];

            //Приводим имена ключей, полученные из ядра, к формату битрикса
            $fields['NAME'] = $category['name'];
            unset($category['name']);
            $fields['DESCRIPTION'] = $category['descr'];
            unset($category['descr']);

            //Кроме имени и описания могут быть пользовательские поля, приобразуем их в формат битрикса
            foreach ($category as $key => $value) {
                $fields[substr('UF_' . strtoupper($key), 0, 20)] = $value;
            }

            $categoryList = CIBlockSection::GetList(array(),
                array("IBLOCK_ID" => self :: BLOCK_ID, "UF_ID" => $fields['UF_ID']));

            $oldCategory = $categoryList->GetNext();
            $categoryId = $oldCategory ? $oldCategory['ID'] : false;

            $result = $categoryId ? $categoryElement->Update($categoryId, $fields) : $categoryElement->Add($fields);
            //$categoryElement->Update возвращает true при успехе. Заменим его на id обновленной категории.
            if ($result === true) $result = $categoryId;
            return $result ? $result : $categoryElement->LAST_ERROR;
        }

        return false;
    }

    //Возвращает массив хэшей каталога. Ключ массива соответствует id города в ядре. Нулевой элемент массива - хэш категорий.
    //Возвращает false, если не удалось получить хэш категорий или ни одного хэша города.
    //$cities - массив id городов в ядре, по которым нужно получить хэши.
    public function receiveHashes($cities){
        $hashes = [];
        $hashExists = false; //true если был получен хотя бы один хэш города

        curl_setopt($this->curl, CURLOPT_URL, self :: SERVER_URL . '/adm/categories/getlist?type=json&count=true');
        $out = curl_exec($this->curl);
        $out = json_decode($out, true);

        if (! $out) return false;

        $hashes[0] = $out['info']['hash'];

        foreach ($cities as $city){
            curl_setopt($this->curl, CURLOPT_URL, self :: SERVER_URL . '/adm/partners/getcatalog?type=json&no_groups=true&count=true&city_id=' . $city);
            $out = curl_exec($this->curl);
            $out = json_decode($out, true);
            if ($out) $hashExists = true;
            $hashes[$city] = $out ? $out['info']['hash'] : false;
        }

        return $hashExists ? $hashes : false;
    }

    public function saveHashesToFile($hashes){
        return file_put_contents($_SERVER["DOCUMENT_ROOT"] . self :: HASH_FILE, json_encode($hashes));
    }

    public function loadHashesFromFile(){
        $hashes = file_get_contents($_SERVER["DOCUMENT_ROOT"] . self :: HASH_FILE);
        return $hashes ? json_decode($hashes, true) : false;
    }

    //Возвращает массив id городов ядра
    public function receiveCityList($onlyId = true){
        curl_setopt($this->curl, CURLOPT_URL, self :: SERVER_URL . '/adm/cities/getlist?type=json');
        $out = curl_exec($this->curl);
        $out = json_decode($out, true);

        //"вышелушеваем" id городов из разветвленной структуры ответа
        $cityList = $out['info']['list'];

        if ($onlyId) {

            foreach ($cityList as $key => $city) {
                $cityList[$key] = $city['id'];
            }
        }

        return $cityList;
    }

    //Импортирует из ядра в инфоблок Битрикса всех партнеров из одного города, id ядра которого равен $city.
    //Если $city == false будет импортирован список категорий.
    public function importPartnersOrCategories($city){
        $list = $city ? $this -> getPartnerList($city) : $this -> getCategoryList();
        $placeholder = $city ? 'Partner' : 'Category';

        foreach ($list as $item) {
            $result = $city ? $this -> addPartnerToInfoblock($item) : $this -> addCategoryToInfoblock($item);
            $message = is_numeric($result) ? $placeholder . ' with id ' . $result . ' was created or updated' : 'ERROR: ' . $result;
            $this -> log($message);
        }
    }

    //Сравнивает хэши ядра и хэши, сохраненные в файле. При обнаружении расхождений в хешах для какого-либо города
    //или списка категорий, запускает процесс обновления.
    public function updateCatalog(){
        $this -> log('=== Starting catalog update ===');
        $cities = $this ->receiveCityList();
        $oldHashes = $this -> loadHashesFromFile();
        $actualHashes = $this -> receiveHashes($cities);

        foreach ($actualHashes as $city => $hash){
            $placeholder = $city ? 'city id ' . $city : 'category list'; //Нулевой id города означает список категорий
            $this -> log('-- checking ' . $placeholder . ' --');
            if ($oldHashes[$city] != $hash) $this->importPartnersOrCategories($city);
        }

        $this -> saveHashesToFile($actualHashes);
        $this -> log('=== Catalog update ends ===');
    }

    //Возвращает массив описания файла логотипа партнера в формате Битрикс или false, если файла логотипа нет
    public function getPartnerLogo($partnerId){
        //Сначала ищем среди ранее масштабированных логотипов
        $searchResult = glob($_SERVER["DOCUMENT_ROOT"] .
                                self :: LOGO_IMG_DIR . '/resized' .
                                $partnerId . '.{' .
                                self :: LOGO_IMG_EXTENSIONS . '}'
            , GLOB_BRACE);

        if (! empty($searchResult)){
            return CFile::MakeFileArray($searchResult[0]);
        }

        //Потом ищем в каталоге загруженных логотипов
        $searchResult = glob($_SERVER["DOCUMENT_ROOT"] .
                                self :: LOGO_IMG_DIR . '/' .
                                $partnerId . '.{' .
                                self :: LOGO_IMG_EXTENSIONS . '}'
            , GLOB_BRACE);

        //Масштабируем загруженный пользователем логотип
        if (! empty($searchResult)){
            $resizedFile = $_SERVER["DOCUMENT_ROOT"] . self :: LOGO_IMG_DIR . '/resized/' . $partnerId . '.jpg';
            CFile :: ResizeImageFile($searchResult[0], $resizedFile, self :: $logoImgSize, BX_RESIZE_IMAGE_PROPORTIONAL, false, 95, false);
            return CFile::MakeFileArray($resizedFile);
        }

        return false;
    }
}