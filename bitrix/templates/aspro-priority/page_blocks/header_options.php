<?global $arTheme, $arRegion;
$headerType = ($arTheme['HEADER_TYPE'] && !is_array($arTheme['HEADER_TYPE']) ? $arTheme['HEADER_TYPE'] : $arTheme['HEADER_TYPE']['VALUE']);
$bOrder = (isset($arTheme['ORDER_VIEW']['VALUE']) && $arTheme['ORDER_VIEW']['VALUE'] == 'Y' && $arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['ORDER_BASKET_VIEW']['VALUE']=='HEADER' || $arTheme['ORDER_VIEW'] == 'Y' && $arTheme['ORDER_BASKET_VIEW'] == 'HEADER' ? true : false);
$bCabinet = CPriority::GetFrontParametrValue('CABINET') === 'Y';
if($arRegion)
	$bPhone = ($arRegion['PHONES'] ? true : false);
else
	$bPhone = ((int)$arTheme['HEADER_PHONES'] ? true : false);
$logoClass = (CPriority::GetFrontParametrValue('COLORED_LOGO') !== 'Y' ? '' : ' colored');
$fixedMenuClass = (is_array($arTheme['TOP_MENU_FIXED']) && $arTheme['TOP_MENU_FIXED']['VALUE'] == 'Y' || $arTheme['TOP_MENU_FIXED'] == 'Y' ? ' canfixed' : '');
$basketViewClass = (is_array($arTheme["ORDER_BASKET_VIEW"]) && $arTheme["ORDER_BASKET_VIEW"]["VALUE"] ? ' '. strtolower(CPriority::GetFrontParametrValue('ORDER_BASKET_VIEW')) : ' '. strtolower($arTheme["ORDER_BASKET_VIEW"]));?>