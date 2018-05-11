<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("УБС Благодарю");
?><div class="col-md-12">
 <a target="_blank" href="http://stofilter.ru"> <img alt="Баннер Фильтра большой" src="/upload/medialibrary/21e/21e8b6f37d50e40fb4687b7f242fc71b.jpg" style="max-width: 100%;" title="Баннер Фильтра большой" class="detail_picture"> </a> <br>
	<br>
</div>
<?
	$mainPageCatalogFilter = Array('>PROPERTY_mainpage_order' => '0', 'PROPERTY_city' => $_SESSION['SESS_CURRENT_CITY']['BITRIX_ID']);

	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"partners_pallet",
		Array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "Y",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array("", ""),
			"FILTER_NAME" => "mainPageCatalogFilter",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "6",
			"IBLOCK_TYPE" => "partners",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "9",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array("", ""),
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SORT_BY1" => "PROPERTY_mainpage_order",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "ASC",
			"SORT_ORDER2" => "ASC"
		)
	);
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>