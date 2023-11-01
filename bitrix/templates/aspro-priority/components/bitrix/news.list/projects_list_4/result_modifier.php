<?
foreach($arResult['ITEMS'] as $key => $arItem)
{
	if($SID = $arItem['IBLOCK_SECTION_ID']){
		$arSectionsIDs[] = $SID;
	}
	CPriority::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));

	$arElementsIds[] = $arItem['ID'];

	$arResult['ITEMS'][$key]['FILTER_DATE'] = 'd-'.ConvertDateTime($arItem['ACTIVE_FROM'], 'YYYY');	
}

if($arSectionsIDs){
	$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
}


$resGroups = CIBlockElement::GetElementGroups($arElementsIds, false, array('id', 'IBLOCK_ELEMENT_ID') );
while($group = $resGroups->Fetch()){
	$arResult['SECTIONS_ELEMENTS'][$group['IBLOCK_ELEMENT_ID']] .= 's-'.$group['ID'].' ';
}
?>