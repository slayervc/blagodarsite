<?
$this->addExternalJS("/local/js/catalog/scripts.min.js");
$this->addExternalJS("/local/js/catalog/common.js");
?><?
$this->addExternalJS("/local/js/catalog/scripts.min.js");
$this->addExternalJS("/local/js/catalog/common.js");
?>

<div class="company-search">
    <div class="row">
        <div class="col-md-9 col-xs-8 company-search__column">
            <div class="company-search__input-wrapper">
                <input type="text" id="catalogSearchRequest" class="company-search__input"
                       onkeypress="catalogSearchRequestOnKeyPress(event)" placeholder="Поиск по названию или описанию"
                       value="<? echo $arResult['CATALOG_SEARCH_REQUEST'] ?>">
            </div>
        </div>
        <div class="col-md-3 col-xs-4 company-search__column">
            <button class="company-search__search-button pull-right" onclick="catalogSearch()">Найти</button>
        </div>
    </div>
</div>

<div class="adv-search">
    <div class="adv-search__btn adv-search__btn-toggle"><span>Расширеный поиск</span>
    </div>
    <div class="adv-search__panel" style="display: none">
        <div class="row">
            <div class="col-md-3 col-sm-6 col">
                <select class="adv-search__select" data-placeholder="Категория" id="catalogSearchCategory">
                    <option value="0" class="category">Текущая категория</option>
                    <option value="all" class="category">Все категории</option>
                    <?
                        foreach ($arResult['CATEGORY_LIST'] as $categoryItem){
                            $class = $categoryItem['DEPTH_LEVEL'] == 1 ? ' class="category"' : '';
                            $optionHTML = '<option' . $class . ' value="' . $categoryItem['ID'] . '">' . $categoryItem['NAME'] . '</option>';
                            echo $optionHTML;
                        }
                    ?>
                </select>
            </div>
            <!-- .col-md-3.col-sm-6-->
            <div class="col-md-3 col-sm-6 col">
                <select class="adv-search__select" data-placeholder="Город" id="catalogSearchCity">
                    <option value="all" class="category">Все города</option>
                    <?
                    $selectedCity = $_GET['city'] ? $_GET['city'] : $_SESSION['SESS_CURRENT_CITY']['CITY_ID'];

                    foreach ($arResult['CITY_LIST'] as $region => $cities){
                        echo ('<optgroup label="' . $region . '">');

                        foreach ($cities as $city){
                            $selected = $city['CITY_ID'] == $selectedCity ? ' selected' : '';
                            echo('<option value="' . $city['CITY_ID'] . '"' . $selected . '>' . $city['CITY_NAME'] . '</option>');
                        }

                        echo ('</optgroup>');
                    }
                    ?>
                </select>
            </div>
            <!-- .col-md-3.col-sm-6-->
            <div class="col-md-3 col-sm-6 col">
                <input type="tel" placeholder="Номер телефона" id="catalogSearchPhone" value="<? echo $arResult['PHONE'] ?>" onkeypress="catalogSearchRequestOnKeyPress(event)"/>
            </div>
            <!-- .col-md-3.col-sm-6-->
            <div class="col-md-3 col-sm-6 col">
                <input type="text" placeholder="Адрес" id="catalogSearchAddress" value="<? echo $arResult['ADDRESS'] ?>" onkeypress="catalogSearchRequestOnKeyPress(event)"/>
            </div>
            <!-- .col-md-3.col-sm-6-->
        </div>

        <div class="row">
            <small>Если вы хотите выполнить поиск по городу, которого нет в списке, введите название этого города в поле "Адрес".</small>
        </div>
    </div>
    <!-- adv-search-->
</div>