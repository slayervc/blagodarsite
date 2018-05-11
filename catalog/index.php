<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><div class="col-md-12">
	 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.catalog.search",
	"",
Array()
);?> <!--br>
 <a target="_blank" href="http://stofilter.ru"> <img alt="Баннер Фильтра большой" src="/upload/medialibrary/21e/21e8b6f37d50e40fb4687b7f242fc71b.jpg" style="max-width: 100%;" title="Баннер Фильтра большой" class="detail_picture"> </a-->
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"columns",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "partners",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "/catalog/category.php?SECTION_ID=#SECTION_ID#",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE"
	)
);?>
</div>
<?
$partnerCatalogFilter = $GLOBALS['PARTNER_CATALOG_FILTER'];
unset($GLOBALS['PARTNER_CATALOG_FILTER']);

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
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("", ""),
		"FILTER_NAME" => "partnerCatalogFilter",
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
		"PAGER_TITLE" => "Предприятия",
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
		"SORT_BY1" => "NAME",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC"
	)
);
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>