<?
$bAjaxMode = (isset($_POST["AJAX_POST"]) && $_POST["AJAX_POST"] == "Y");
if ($bAjaxMode) {
	require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	global $APPLICATION;
}

if (\Bitrix\Main\Loader::includeModule('aspro.priority')) {
	$arTheme = CPriority::GetFrontParametrsValues(SITE_ID);
}

if ((isset($arParams["IBLOCK_ID"]) && $arParams["IBLOCK_ID"]) || $bAjaxMode) {
	$arIncludeParams = ($bAjaxMode ? $_POST["AJAX_PARAMS"] : $arParamsTmp);
	$arGlobalFilter = ($bAjaxMode ? $_POST["GLOBAL_FILTER"] : '');
	$signer = new \Bitrix\Main\Component\ParameterSigner();
	try {
		$componentName = CPriority::PARTNER_NAME . ':tabs.' . CPriority::SOLUTION_NAME;
		$arComponentParams = $signer->unsignParameters($componentName, $arIncludeParams);
		$arGlobalFilter = strlen($arGlobalFilter) ? $signer->unsignParameters($componentName, $arGlobalFilter) : [];
	} catch (\Bitrix\Main\Security\Sign\BadSignatureException $e) {
		die($e->getMessage());
	}

	if ($bAjaxMode && (is_array($arGlobalFilter) && $arGlobalFilter)) {
		$GLOBALS[$arComponentParams["FILTER_NAME"]] = $arGlobalFilter;
	}
	$GLOBALS[$arComponentParams["FILTER_NAME"]]["!PROPERTY_SHOW_ON_INDEX_PAGE"] = false;

	$template = isset($arTheme['ELEMENTS_TABLE_TYPE_VIEW']) && $arTheme['ELEMENTS_TABLE_TYPE_VIEW'] === 'catalog_table_2' ? 'front-catalog-slider_2' : 'front-catalog-slider';
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		$template,
		$arComponentParams,
		false,
		array('HIDE_ICONS' => 'Y')
	);
}
