
<p><?echo $arResult['CURRENT_CITY']?></p>

<div class="col-md-12">
    <div class="company-search">
        <div class="row">
            <div class="col-md-3 company-search__column">
                <div class="company-search__name-badge">
                    Каталог компаний
                </div>
            </div>
            <div class="col-md-6 col-xs-8 company-search__column">
                <div class="company-search__input-wrapper">
                    <input type="text" id="catalogSearchRequest" class="company-search__input" placeholder="Введите назавние компании или вид деятельности" value="<?echo $arResult['CATALOG_SEARCH_REQUEST']?>">
                </div>
            </div>
            <div class="col-md-3 col-xs-4 company-search__column">
                <button class="company-search__search-button pull-right" onclick="catalogSearch()">
                    Найти </button>
            </div>
        </div>
    </div>
</div>