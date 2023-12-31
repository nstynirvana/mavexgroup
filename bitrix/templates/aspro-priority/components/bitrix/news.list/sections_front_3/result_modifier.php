<?
global $arTheme, $arRegion;
// get all subsections of PARENT_SECTION or root sections
$arSectionsFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y');
$arParams['DEPTH_LEVEL'] = 1;
$start_level = ($arResult['SECTION']['PATH'][0]['DEPTH_LEVEL'] ? $arResult['SECTION']['PATH'][0]['DEPTH_LEVEL'] : 1);
$end_level = $arParams['DEPTH_LEVEL'];

// Only Elements
if($arParams['SERVICES_ONLY'] === "Y"){

	$arElements = array();
	$arElementsFilter = ($GLOBALS[$arParams['FILTER_NAME']] ? array_merge(array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', "!PROPERTY_SHOW_ON_INDEX_PAGE" => false), $GLOBALS[$arParams['FILTER_NAME']]) : array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', "!PROPERTY_SHOW_ON_INDEX_PAGE" => false));
	$arElementsSelect = array('ID', 'NAME', 'IBLOCK_ID', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'PROPERTY_ICON');

	$arElements = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), 'MULTI' => 'Y')), $arElementsFilter, false, false, $arElementsSelect);

	if($arElements) {
		$arResult['IS_ELEMENTS'] = true;
		$arResult['SECTIONS'] = $arElements;
	}

} else {
	if($arParams['PARENT_SECTION'])
	{
		$arParentSection = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), array('ID' => $arParams['PARENT_SECTION']), false, array('ID', 'IBLOCK_ID', 'LEFT_MARGIN', 'RIGHT_MARGIN'));

		$arSectionsFilter = array_merge($arSectionsFilter, array(/*'SECTION_ID' => $arParams['PARENT_SECTION'],*/'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => '1'));

		$arSectionsFilter['INCLUDE_SUBSECTIONS'] = 'Y';
		$arSectionsFilter['<=DEPTH_LEVEL'] = $end_level;

	}
	else
	{
		$arSectionsFilter['<=DEPTH_LEVEL'] = $end_level;
	}

	if(CPriority::GetFrontParametrValue('SHOW_SECTIONS_REGION') == 'Y' && CPriority::GetFrontParametrValue('REGIONALITY_FILTER_ITEM') == 'Y' && $arRegion){
		$arSectionsID = array();
		$arElementsFilter = ($GLOBALS[$arParams['FILTER_NAME']] ? array_merge(array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), $GLOBALS[$arParams['FILTER_NAME']]) : array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'));
		$arElements = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), 'MULTI' => 'Y')), $arElementsFilter, false, false, array('IBLOCK_SECTION_ID'));
		if($arElements){
			foreach($arElements as $arElement){
				if($arElement['IBLOCK_SECTION_ID'] && !in_array($arElement['IBLOCK_SECTION_ID'], $arSectionsID)){
					$arSectionsID[] = $arElement['IBLOCK_SECTION_ID'];
				}
			}
			
			if($arSectionsID){
				$arSectionsFilter['ID'] = $arSectionsID;
			}
			
		}
	}

	$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), $arSectionsFilter, false, array('ID', 'NAME', 'IBLOCK_ID', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'DESCRIPTION', 'UF_ICON', 'UF_BACKGROUND'));
}
?>