<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(\Bitrix\Main\Loader::includeModule("aspro.next"))
{
	global $arRegion;
	$arRegion = CNextRegionality::getCurrentRegion();
}
?>