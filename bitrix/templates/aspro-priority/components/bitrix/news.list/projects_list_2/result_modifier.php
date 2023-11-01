<?
if($arResult['ITEMS'])
{
	$arSectionsIDs = array();

	foreach($arResult['ITEMS'] as $key => $arItem)
	{
		$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = CPriority::FormatNewsUrl($arItem);
		CPriority::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
		if($SID = $arItem['IBLOCK_SECTION_ID'])
		{
			$arSectionsIDs[] = $SID;
		}
		$arResult['ITEMS'][$key]['FILTER_DATE'] = 'd-'.ConvertDateTime($arItem['ACTIVE_FROM'], 'YYYY');	

		$arElementsIds[] = $arItem['ID'];
	}

	if($arSectionsIDs){
		$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
	}

	$arResult['COUNT_ELEMENTS'] = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), array());

	$resGroups = CIBlockElement::GetElementGroups($arElementsIds, false, array('id', 'IBLOCK_ELEMENT_ID') );
	while($group = $resGroups->Fetch()){
		$arResult['SECTIONS_ELEMENTS'][$group['IBLOCK_ELEMENT_ID']] .= 's-'.$group['ID'].' ';
	}
}
?>