<?
$arResult = CPriority::getChilds($arResult);

global $APPLICATION, $arRegion, $arTheme;

if($arResult){
	foreach($arResult as $key=>$arItem)
	{
		if(isset($arItem['CHILD']))
		{
			foreach($arItem['CHILD'] as $key2=>$arItemChild)
			{
				$bSectionChildRegion = false;
				if($arItemChild['PARAMS']['TYPE'] == 'PRODUCT'){
					unset($arResult[$key]['CHILD'][$key2]);
				}

				$arMenuParametrs = CPriority::GetDirMenuParametrs($_SERVER['DOCUMENT_ROOT'].'/'.str_replace('/', '', $arItem['LINK']));

				if($arRegion && $arTheme['USE_REGIONALITY']['VALUE'] === 'Y' && $arTheme['USE_REGIONALITY']['DEPENDENT_PARAMS']['REGIONALITY_FILTER_ITEM']['VALUE'] === 'Y'/* && ($arTheme['SHOW_SECTIONS_REGION']['VALUE'] == 'Y' || $arMenuParametrs['MENU_SHOW_SECTIONS'] != 'Y')*/)
				{
					// filter items by region
					if(isset($arItemChild['PARAMS']) && isset($arItemChild['PARAMS']['LINK_REGION']) && $arItemChild['PARAMS']['FROM_IBLOCK'] && !isset($arItemChild['CHILD'])){
						if(isset($arItemChild['PARAMS']['LINK_REGION']))
						{
							if($arItemChild['PARAMS']['LINK_REGION'])
							{
								if(!in_array($arRegion['ID'], $arItemChild['PARAMS']['LINK_REGION'])){
									unset($arResult[$key]['CHILD'][$key2]);
								}
								else{
									$bSectionChildRegion = true;
								}
							}
							else{
								unset($arResult[$key]['CHILD'][$key2]);
							}
						}
					}
					elseif($arItemChild['CHILD']){
						foreach($arItemChild['CHILD'] as $key3 => $arSubChild){
							if(isset($arSubChild['PARAMS']['LINK_REGION']))
							{
								if(isset($arSubChild['PARAMS']) && isset($arSubChild['PARAMS']['LINK_REGION']))
								{
									if(!in_array($arRegion['ID'], (array)$arSubChild['PARAMS']['LINK_REGION'])){
										unset($arResult[$key]['CHILD'][$key2]['CHILD'][$key3]);
									}
									else{
										$bSectionChildRegion = true;
									}
								}
								else{
									unset($arResult[$key]['CHILD'][$key2]['CHILD'][$key3]);
								}
							}
						}
						if(!$bSectionChildRegion && $arTheme['SHOW_SECTIONS_REGION']['VALUE'] == 'Y'){
							unset($arResult[$key]['CHILD'][$key2]);
						}
					}
					elseif(isset($arItemChild['PARAMS']) && $arItemChild['PARAMS']['FROM_IBLOCK'] && !isset($arItemChild['CHILD']) && !isset($arItemChild['PARAMS']['LINK_REGION'])){
						unset($arResult[$key]['CHILD'][$key2]);
					}
				}

				if($arMenuParametrs['MENU_SHOW_ELEMENTS'] != 'Y' && $arItemChild['CHILD']){
					foreach($arItemChild['CHILD'] as $key3 => $arSubChild){
						if($arMenuParametrs['MENU_SHOW_ELEMENTS'] != 'Y' && $arItemChild['CHILD'] && isset($arSubChild['PARAMS']['LINK_REGION'])){
							unset($arResult[$key]['CHILD'][$key2]['CHILD'][$key3]);
						}
						if($arSubChild['CHILD']){
							foreach($arSubChild['CHILD'] as $key4 => $arSubSubChild){
								unset($arResult[$key]['CHILD'][$key2]['CHILD'][$key3]['CHILD'][$key4]);
							}
						}
					}
				}
			}
		}
	}
}
?>
<?

	foreach ($arResult as &$arChild):
		if ($arChild["LINK"] == "/product/") {
			$arChild["UF_SHOW_LINK"] = 1;
			foreach ($arChild["CHILD"] as &$child):
				$uf_name = Array("UF_SHOW_LINK");
				$code = explode("/", $child["LINK"]);
				$code = $code[2];
				$uf_arresult = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 36, "CODE" => $code), false, $uf_name);
				if($uf_value = $uf_arresult->GetNext()):
					if ($uf_value["UF_SHOW_LINK"] == 1) {
						$child["UF_SHOW_LINK"] = 1;
					}
				endif;
			endforeach;	
				
		}
		if ($arChild["LINK"] == "/services/") {
			$arChild["UF_SHOW_LINK"] = 1;
			foreach ($arChild["CHILD"] as &$child):
				$uf_name = Array("UF_SHOW_LINK");
				$code = explode("/", $child["LINK"]);
				$code = $code[2];
				$uf_arresult = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 34, "CODE" => $code), false, $uf_name);
				if($uf_value = $uf_arresult->GetNext()):
					if ($uf_value["UF_SHOW_LINK"] == 1) {
						$child["UF_SHOW_LINK"] = 1;
					}
				endif;
			endforeach;	
				
		}
	endforeach;	

?>