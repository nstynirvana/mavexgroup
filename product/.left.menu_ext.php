<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();

if($arMenuParametrs = CPriority::GetDirMenuParametrs(__DIR__))
{
	$iblock_id = CCache::$arIBlocks[SITE_ID]['aspro_priority_catalog']['aspro_priority_catalog'][0];
	$arExtParams = array(
		'IBLOCK_ID' => $iblock_id,
		'MENU_PARAMS' => $arMenuParametrs,
		'SECTION_FILTER' => array(),	// custom filter for sections (through array_merge)
		'SECTION_SELECT' => array(),	// custom select for sections (through array_merge)
		'ELEMENT_FILTER' => array(),	// custom filter for elements (through array_merge)
		'ELEMENT_SELECT' => array(),	// custom select for elements (through array_merge)
		'MENU_TYPE' => 'catalog',
	);
	CPriority::getMenuChildsExt($arExtParams, $aMenuLinksExt);
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>