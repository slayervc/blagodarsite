
			</div>
		</div>
	</main>

<footer class="footer">
	<div class="container">
		<div class="footer__content-block">
			<div class="row">
				<div class="col-md-4">
					<div class="footer__col-main">
						<div class="footer__col-header">
							<h4 class="footer__col-header-block footer__col-header-block--text">Лучшие предложения</h4>
							<a href="/offers" class="footer__col-header-block footer__col-header-block--button">Все</a>
						</div>
						<div class="footer__col-content">
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"footercol_offers",
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
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "Y",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array("",""),
									"FILTER_NAME" => "",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => "9",
									"IBLOCK_TYPE" => "offers",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
									"INCLUDE_SUBSECTIONS" => "Y",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "3",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => ".default",
									"PAGER_TITLE" => "Лучшие предложения",
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
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="footer__col-main">
						<div class="footer__col-header">
							<h4 class="footer__col-header-block footer__col-header-block--text">Акции</h4>
							<a href="/campaigns" class="footer__col-header-block footer__col-header-block--button">Все</a>
						</div>

						<div class="footer__col-content">
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"",
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
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array("",""),
									"FILTER_NAME" => "",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => "10",
									"IBLOCK_TYPE" => "offers",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
									"INCLUDE_SUBSECTIONS" => "Y",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "3",
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
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="footer__col-main">
						<div class="footer__col-header">
							<h4 class="footer__col-header-block footer__col-header-block--text">Новости</h4>
							<a href="/news" class="footer__col-header-block footer__col-header-block--button">Все</a>
						</div>
						<div class="footer__col-content">
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"footercol",
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
									"FIELD_CODE" => array("",""),
									"FILTER_NAME" => "",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => "2",
									"IBLOCK_TYPE" => "news",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
									"INCLUDE_SUBSECTIONS" => "Y",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "3",
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
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer__main-foot">
			<div class="row">
				<div class="col-md-4">
					<div class="footer__logo">
						<img src="<?php echo SITE_TEMPLATE_PATH?>/dist/images/logo.png">
					</div>
					<div class="footer__copyright">
						© Copyright 2016. Все права защищены
					</div>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"bottom",
						Array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_THEME" => "site",
							"ROOT_MENU_TYPE" => "bottom",
							"USE_EXT" => "N"
						)
					);?>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs">
					<div class="footer__auth-actions">
						<a href="#" class="footer__auth-button">
							Вход для партнеров
						</a>
						<a href="#" class="footer__auth-button">
							Вход для клиентов
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="footer__low-foot">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="footer__social-links">
						<span>Мы в соц.сетях: </span>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="footer__privacy-policy pull-right">
						<a href="#" class="footer__link">Политика конфиденциальности</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</body>
</html>