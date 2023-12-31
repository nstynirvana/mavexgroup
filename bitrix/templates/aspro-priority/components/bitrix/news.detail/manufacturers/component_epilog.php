<?
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$bOrderViewBasket = $templateData["ORDER"];
$arManafacturerItemsID = array();
$arManafacturerItems = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["CATALOG_IBLOCK_ID"]), "MULTI" => "N", 'GROUP' => array('ID'))), array('IBLOCK_ID' => $arParams["CATALOG_IBLOCK_ID"], 'PROPERTY_BRAND' => $arResult['ID']), false, false, array("ID"));
if($arManafacturerItems){
	foreach($arManafacturerItems as $key => $arItem){
		$arManafacturerItemsID[] = $key;
	}
}
?>
<div class="detail partners_links">
	<?if($arManafacturerItems):?>
		<div class="wraps">
			<h4><?=(strlen($arParams['T_ITEMS']) ? $arParams['T_ITEMS'] : Loc::getMessage('T_ITEMS'))?></h4>
			<?$GLOBALS['arrGoodsFilter'] = array('ID' => $arManafacturerItemsID);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				$templateData['CATALOG_LINKED_TEMPLATE'],
				Array(
					"S_ORDER_PRODUCT" => $arParams["S_ORDER_SERVISE"],
					"IBLOCK_TYPE" => "aspro_priority_catalog",
					"IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrGoodsFilter",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "PREVIEW_TEXT",
						2 => "PREVIEW_PICTURE",
						3 => "DETAIL_PICTURE",
						4 => "",
					),
					"PROPERTY_CODE" => array(
						0 => "PRICE",
						1 => "PRICEOLD",
						2 => "STATUS",
						3 => "ARTICLE",
						6 => "CATEGORY",
						7 => "RECOMMEND",
						10 => "DELIVERY",
						21 => "SUPPLIED",
						23 => "LANGUAGES",
						24 => "DURATION",
						25 => "UPDATES",
						26 => "RANGE_MEASURE",
						27 => "WORK_TEMP",
						28 => "NUM_CHANNELS",
						29 => "DIMENSIONS",
						30 => "MASS",
						31 => "MAX_SPEED",
						32 => "MODEL_ENGINE",
						33 => "VOLUME_ENGINE",
						34 => "SEATS",
						35 => "COUNTRY",
						36 => "WORK_PRESSURE",
						37 => "BENDING_ANGLE",
						38 => "ENGINE_POWER",
						39 => "WORK_SPEED",
						40 => "GUARANTEE",
						41 => "COMMUNIC_PORT",
						42 => "INNER_MEMORY",
						43 => "PRESS_POWER",
						44 => "MAXIMUM_PRESSURE",
						45 => "MAX_SIZE_ZAG",
						46 => "BENDING_SIZE",
						47 => "MAX_MASS_ZAG",
						48 => "POWER_LS",
						49 => "V_DVIGATELJA",
						50 => "RAZGON",
						51 => "BRAND",
						52 => "PROIZVODITEKNOST",
						53 => "MAX_POWER_LS",
						54 => "LINK_SERTIFICATES",
						55 => "MAX_POWER",
						56 => "AGE",
						57 => "KARTOPR",
						58 => "DEPTH",
						59 => "GRUZ",
						60 => "GRUZ_STRELI",
						61 => "DLINA_STRELI",
						62 => "DLINA",
						63 => "CLASS",
						64 => "KOL_FORMULA",
						65 => "MARK_STEEL",
						66 => "MODEL",
						67 => "POWER",
						68 => "VOLUME",
						69 => "PROIZVODSTVO",
						70 => "SIZE",
						71 => "SPEED",
						72 => "TYPE_TUR",
						73 => "THICKNESS",
						74 => "MARK",
						75 => "FREQUENCY",
						76 => "WIDTH_PROHOD",
						77 => "WIDTH_PROEZD",
						78 => "WIDTH",
						79 => "PLACE_CLOUD",
						80 => "TYPE",
						81 => "COLOR",
						82 => "",
						83 => "",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "�������",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"SHOW_DETAIL_LINK" => "Y",
					"COUNT_IN_LINE" => "3",
					"IMAGE_POSITION" => "left",
					"ORDER_VIEW" => $bOrderViewBasket,
				),
			false, array("HIDE_ICONS" => "Y")
			);?>
		</div>
	<?endif;?>
</div>