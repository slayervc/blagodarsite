<?php

define('PARTNERIMPORT_SERVER_URL', 'https://xn----8sbntbegpkx.xn--p1ai/vt1.1');
define('PARTNERIMPORT_BLOCK_ID', 11);

//Авторизуется в ядре, возвращает токен доступа или false
function getAuthToken(){
    if ($curl = curl_init()) {
        $authRequest = ["login" => "SYSTEM", "password" => 'PASS'];

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $authRequest);
        curl_setopt($curl, CURLOPT_URL, PARTNERIMPORT_SERVER_URL . '/adm/tokens?type=json');

        $token = curl_exec($curl);
        curl_close($curl);
        return $token ? json_decode($token)->info->token : false;
    }
}

//Запрашивает из ядра каталог партнеров. Возвращает массив ассоциативных массивов или false.
function getPartnerList($city)
{
    if ($curl = curl_init()) {
        $catalogRequest = ['token' => '', 'count' => false, 'city_id' => $city];
        $catalogRequest['token'] = getAuthToken();
        if (! $catalogRequest['token']) return false;

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $catalogRequest);
        curl_setopt($curl, CURLOPT_URL, PARTNERIMPORT_SERVER_URL . '/adm/partners/getcatalog?type=json&no_groups=true');

        $out = curl_exec($curl);
        $out = json_decode($out, true);
        curl_close($curl);
        return $out['info']['list'];
    }

    return false;
}

//Запрашивает из ядра категории каталога партнеров. Возвращает массив ассоциативных массивов или false.
function getCategoryList(){
    if ($curl = curl_init()) {
        $categoryRequest = ['token' => '', 'count' => false];
        $categoryRequest['token'] = getAuthToken();
        if (! $categoryRequest['token']) return false;

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $categoryRequest);
        curl_setopt($curl, CURLOPT_URL, PARTNERIMPORT_SERVER_URL . '/adm/categories/getlist?type=json');

        $out = curl_exec($curl);
        $out = json_decode($out, true);
        curl_close($curl);
        return $out['info']['list'];
    }

    return false;
}

//Подготавливает запись каталога партнеров $partner, полученную из ядра, к сохранению в инфоблоке Битрикса.

function preparePartnerValues(&$partner){
    //Преобразуем значение свойства "вид клиента" в id списка

    if (array_key_exists('type', $partner)){

        $propertyEnums = CIBlockPropertyEnum::GetList(array(),
            array("IBLOCK_ID" => PARTNERIMPORT_BLOCK_ID, "CODE" => "type", "EXTERNAL_ID" => 'id' . $partner['type']));

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
//кодами свойств инфоблока.
function addPartnerToInfoblock($partner){

    if(CModule::IncludeModule("iblock")) {
        preparePartnerValues($partner);

        //Получаем id категории битрикса из id категории ядра
        $categoryEnums = CIBlockSection::GetList(array(),
            array("IBLOCK_ID" => PARTNERIMPORT_BLOCK_ID, "UF_ID" => $partner['category_id']));

        $categoryFields = $categoryEnums->GetNext();
        $sectionId = $categoryFields ? $categoryFields['ID'] : false;
        $el = new CIBlockElement;

        $arLoadProductArray = Array(
            "IBLOCK_SECTION_ID" => $sectionId,
            "IBLOCK_ID" => PARTNERIMPORT_BLOCK_ID,
            "PROPERTY_VALUES"=> $partner,
            "NAME" => $partner['partner_name'],
            "ACTIVE" => "Y",
            "PREVIEW_TEXT" => $partner['partner_info']
        );

        $PRODUCT_ID = $el->Add($arLoadProductArray);
        return $PRODUCT_ID ? $PRODUCT_ID : $el->LAST_ERROR;
    }

    return false;
}

//Добавляет категорию каталога партнеров в инфоблок Битрикса. $category - ассоциативный массив. Имена ключей приводятся
//к формату названий пользовательских полей битрикса.
function addCategoryToInfoblock($category){

    if(CModule::IncludeModule("iblock")) {
        $bs = new CIBlockSection;

        $fields = ["ACTIVE" => 'Y',
                    "IBLOCK_SECTION_ID" => false,
                    "IBLOCK_ID" => PARTNERIMPORT_BLOCK_ID];

        //Приводим имена ключей, полученные из ядра, к формату битрикса
        $fields['NAME'] = $category['name'];
        unset($category['name']);
        $fields['DESCRIPTION'] = $category['descr'];
        unset($category['descr']);

        //Кроме имени и описания могут быть пользовательские поля, приобразуем их в формат битрикса
        foreach ($category as $key => $value){
            $fields[substr('UF_' . strtoupper($key), 0, 20)] = $value;
        }

        $ID = $bs->Add($fields);
        return $ID ? $ID : $bs->LAST_ERROR;
    }

    return false;
}