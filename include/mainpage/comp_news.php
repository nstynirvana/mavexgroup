<?
use CPriority as Solution;

$bAjaxMode = isset($_POST["AJAX_POST"]) && $_POST["AJAX_POST"] === "Y";
if ($bAjaxMode) {
	require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	global $APPLICATION;
	\Bitrix\Main\Loader::includeModule("aspro.priority");
	if (\Bitrix\Main\Loader::includeModule('aspro.priority')) {
		$arTheme = CPriority::GetFrontParametrsValues(SITE_ID);
	}

	$signer = new \Bitrix\Main\Component\ParameterSigner();
	$arParams = $_POST["AJAX_PARAMS"] ?? '';
	try {
		$componentName = "bitrix:news.list";
		$arParams = $signer->unsignParameters($componentName, $arParams);
		$arParams['NEWS_COUNT'] += $arParams['ADD_ELEMENT_COUNT'];
	} catch (\Bitrix\Main\Security\Sign\BadSignatureException $e) {
		die($e->getMessage());
	}

	$GLOBALS[$arParams['FILTER_NAME']] = array('!PROPERTY_SHOW_ON_INDEX_PAGE' => false);

	//region filter
	if (!$arRegion) {
		$arRegion = CPriorityRegionality::getCurrentRegion();
	} elseif ($arRegion && Solution::GetFrontParametrValue('REGIONALITY_FILTER_ITEM') == 'Y') {
		$GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_LINK_REGION'] = $arRegion['ID'];
	}

	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		$_REQUEST['TEMPLATE_NAME'],
		$arParams,
		false
	);
}
?>