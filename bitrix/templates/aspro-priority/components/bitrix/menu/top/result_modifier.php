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

				if($arRegion && CPriority::GetFrontParametrValue('USE_REGIONALITY') === 'Y' && CPriority::GetFrontParametrValue('REGIONALITY_FILTER_ITEM') === 'Y')
				{				
					// filter items by region
					if(isset($arItemChild['PARAMS']) && isset($arItemChild['PARAMS']['LINK_REGION']) && $arItemChild['PARAMS']['FROM_IBLOCK'] && !isset($arItemChild['CHILD'])){
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
					elseif($arItemChild['CHILD']){
						foreach($arItemChild['CHILD'] as $key3 => $arSubChild){
							if(isset($arSubChild['PARAMS']) && isset($arSubChild['PARAMS']['LINK_REGION']))
							{
								if($arSubChild['PARAMS']['LINK_REGION'])
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
							else if( isset($arSubChild['CHILD']) && $arSubChild['CHILD'] ) {
								foreach($arSubChild['CHILD'] as $key4 => $arSubSubChild){
									if(isset($arSubSubChild['PARAMS']) && isset($arSubSubChild['PARAMS']['LINK_REGION']))
									{
										if($arSubSubChild['PARAMS']['LINK_REGION'])
										{
											if(!in_array($arRegion['ID'], (array)$arSubSubChild['PARAMS']['LINK_REGION'])){
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
							}

						}
						
						if(!$bSectionChildRegion && CPriority::GetFrontParametrValue('SHOW_SECTIONS_REGION') == 'Y' ){
							unset($arResult[$key]['CHILD'][$key2]);
						}
					}
					elseif(isset($arItemChild['PARAMS']) && $arItemChild['PARAMS']['FROM_IBLOCK'] && !isset($arItemChild['CHILD']) && !isset($arItemChild['PARAMS']['LINK_REGION']) && CPriority::GetFrontParametrValue('SHOW_SECTIONS_REGION') == 'Y'){
						unset($arResult[$key]['CHILD'][$key2]);
					}
					
				}
				
				if($arMenuParametrs['MENU_SHOW_ELEMENTS'] != 'Y' && $arItemChild['CHILD']){
					foreach($arItemChild['CHILD'] as $key3 => $arSubChild){
						if($arMenuParametrs['MENU_SHOW_ELEMENTS'] != 'Y' && $arItemChild['CHILD'] && isset($arSubChild['PARAMS']['LINK_REGION'])){
							unset($arResult[$key]['CHILD'][$key2]['CHILD'][$key3]);
						}
					}
				}
			}
		}
	}	
}
?>

<?



if ($arResult[0]["LINK"] == "/product/") {
	foreach ($arResult[0]["CHILD"] as &$arChild):
		$uf_name = Array("UF_SHOW_LINK");
		$code = explode("/", $arChild["LINK"]);
		$code = $code[2];
		$uf_arresult = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 36, "CODE" => $code), false, $uf_name);
		if($uf_value = $uf_arresult->GetNext()):
			if ($uf_value["UF_SHOW_LINK"] == 1) {
				$arChild["UF_SHOW_LINK"] = 1;
			}
		endif;	
	endforeach;	
}
if ($arResult[1]["LINK"] == "/services/") {
	foreach ($arResult[1]["CHILD"] as &$arChild):
		$uf_name = Array("UF_SHOW_LINK");
		$code = explode("/", $arChild["LINK"]);
		$code = $code[2];
		$uf_arresult = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 34, "CODE" => $code), false, $uf_name);
		if($uf_value = $uf_arresult->GetNext()):
			if ($uf_value["UF_SHOW_LINK"] == 1) {
				$arChild["UF_SHOW_LINK"] = 1;
			}
		endif;
	endforeach;
}

?>