<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);
$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());

// rss
if($arParams['USE_RSS'] !== 'N'){
	CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
}
?>
<?if(!$itemsCnt):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?global $arTheme;?>
	<?// section elements?>
	<?// intro text?>
	<div class="row">
		<div class="col-md-12">
		<div class="text_before_items"><!--
			--><?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "page",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => ""
				)
			);?><!--
		--></div>
		</div>
	</div>

	<?$sViewElementsTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["STAFF_PAGE"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);?>
	<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>
<?endif;?>