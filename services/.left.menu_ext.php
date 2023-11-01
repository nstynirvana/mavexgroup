<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();

if($arMenuParametrs = CPriority::GetDirMenuParametrs(__DIR__))
{
	$iblock_id = CCache::$arIBlocks[SITE_ID]['aspro_priority_catalog']['aspro_priority_services'][0];
	$arExtParams = array(
		'IBLOCK_ID' => $iblock_id,
		'MENU_PARAMS' => $arMenuParametrs,
		'SECTION_FILTER' => array(),	// custom filter for sections (through array_merge)
		'SECTION_SELECT' => array(),	// custom select for sections (through array_merge)
		'ELEMENT_FILTER' => array(),	// custom filter for elements (through array_merge)
		'ELEMENT_SELECT' => array(),	// custom select for elements (through array_merge)
		'MENU_TYPE' => 'services',
	);
	CPriority::getMenuChildsExt($arExtParams, $aMenuLinksExt);
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);


foreach ($aMenuLinks as &$link) {
	if ($link[0] == "Монтаж оборудования" && $link[1] == "/services/sistemy-protivopozharnoy-zashchity/montazh-oborudovaniya/") {
		$link[1] = "";
	}
}

//echo "<pre>";
//print_r($aMenuLinks);
//echo "</pre>";

?>