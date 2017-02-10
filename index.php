<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?>
	<?php if (!$USER->IsAuthorized()): ?>
		<div class="col-md-12">
			<div class="auth-block">
				<div class="row">
					<div class="col-md-6">
						 <?$APPLICATION->IncludeComponent(
							"bitrix:system.auth.form",
							"partner-auth",
							Array(
								"CLIENT_TYPE" => "Partner",
								"FORGOT_PASSWORD_URL" => "auth/forgot-password.php",
								"PROFILE_URL" => "profile/partner/",
								"REGISTER_URL" => "/",
								"SHOW_ERRORS" => "N"
							)
						);?>
					</div>
					<div class="col-md-6">
						 <?$APPLICATION->IncludeComponent(
							"bitrix:system.auth.form",
							"client-auth",
							Array(
								"CLIENT_TYPE" => "Client",
								"FORGOT_PASSWORD_URL" => "/auth/forgot-password.php",
								"PROFILE_URL" => "profile/client/",
								"REGISTER_URL" => "/auth/register.php",
								"SHOW_ERRORS" => "N"
							)
						);?>
					</div>
				</div>
			</div>
		</div>
	<?php endif ?>
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
						<input type="text" class="company-search__input" placeholder="Введите назавние компании или вид деятельности">
					</div>
				</div>
				<div class="col-md-3 col-xs-4 company-search__column">
					<button class="company-search__search-button pull-right">
						Найти
					</button>
				</div>
			</div>
		</div>
	</div>

	<?$APPLICATION->IncludeComponent(
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
			"FIELD_CODE" => array("",""),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "11",
			"IBLOCK_TYPE" => "partners",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "20",
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
			"PROPERTY_CODE" => array("",""),
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC"
		)
	);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

