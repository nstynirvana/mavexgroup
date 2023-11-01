<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карьера");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"vacancy", 
	array(
		"IBLOCK_TYPE" => "aspro_priority_content",
		"IBLOCK_ID" => "10",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "arRegionLink",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/company/vacancy/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "100000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "CITY",
			1 => "PAY",
			2 => "QUALITY",
			3 => "WORK_TYPE",
			4 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "CITY",
			1 => "PAY",
			2 => "QUALITY",
			3 => "LINK_STAFF",
			4 => "WORK_TYPE",
			5 => "LINK_SERVICES",
			6 => "LINK_PROJECTS",
			7 => "LINK_VACANCYS",
			8 => "LINK_FAQ",
			9 => "LINK_SERTIFICATES",
			10 => "LINK_SALE",
			11 => "LINK_REVIEWS",
			12 => "LINK_PARTNERS",
			13 => "LINK_GOODS",
			14 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"VIEW_TYPE" => "list",
		"SHOW_TABS" => "N",
		"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
		"IMAGE_POSITION" => "right",
		"AJAX_OPTION_ADDITIONAL" => "",
		"USE_REVIEW" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"SHOW_DETAIL_LINK" => "Y",
		"COMPONENT_TEMPLATE" => "vacancy",
		"SET_LAST_MODIFIED" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"FORM" => "Y",
		"FORM_ID" => "",
		"FORM_BUTTON_TITLE" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"USE_SHARE" => "Y",
		"REVIEWS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_form"]["aspro_priority_add_review"][0],
		"PROJECTS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_projects"][0],
		"SERVICES_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_services"][0],
		"CATALOG_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_catalog"][0],
		"STAFF_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_staff"][0],
		"PARTNERS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_partners"][0],
		"NEWS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_news"][0],
		"FAQ_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_faq"][0],
		"VACANCYS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_vacancy"][0],
		"SERTIFICATES_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_licenses"][0],
		"SECTION_ELEMENTS_TYPE_VIEW" => "FROM_MODULE",
		"ELEMENT_TYPE_VIEW" => "element_1",
		"STRICT_SECTION_CHECK" => "N",
		"T_PROJECTS" => "",
		"T_FAQ" => "",
		"T_SERVICES" => "",
		"T_ITEMS" => "",
		"T_PARTNERS" => "",
		"T_REVIEWS" => "",
		"T_STAFF" => "",
		"T_VACANCYS" => "",
		"T_SERTIFICATES" => "",
		"FILE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>