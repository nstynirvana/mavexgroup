<?if($arParams['FIELDS']) {	$arResult['EMPTY_FIELDS'] = true;	foreach ($arParams['FIELDS'] as $key => $field) {		if(!$field) {			unset($arParams['FIELDS'][$key]);		} elseif( !($field == 'PHONE' && isset($arParams['USE_STORE_PHONE']) && $arParams['USE_STORE_PHONE'] == 'Y') ) {			$arResult['EMPTY_FIELDS'] = false;		}	}}use \Bitrix\Main\Type\Collection;if(!isset($arProperty["NUM_AMOUNT"])){	$arSelect=array("ID", "PRODUCT_AMOUNT", 'ADDRESS', 'SORT', 'TITLE', 'UF_METRO');	if($arParams["SHOW_GENERAL_STORE_INFORMATION"] != "Y"){		foreach($arResult["STORES"] as $pid => $arProperty){			$arStore = CCatalogStore::GetList(array('TITLE' => 'ASC', 'ID' => 'ASC'), array("ACTIVE" => "Y", "PRODUCT_ID" => $arParams["ELEMENT_ID"], "ID" => $arProperty["ID"]), false, false, $arSelect)->Fetch();			$arResult["STORES"][$pid]["NUM_AMOUNT"] = $arStore["PRODUCT_AMOUNT"];			$arResult["STORES"][$pid]["ADDRESS"] = $arStore["ADDRESS"];			$arResult["STORES"][$pid]["SORT"] = $arStore["SORT"];			$arResult["STORES"][$pid]["TITLE"] = $arStore["TITLE"];			if(isset($arStore["UF_METRO"]))				$arResult["STORES"][$pid]["METRO"] = unserialize($arStore["UF_METRO"]);		}	}else{				$arStoresIds = array();		foreach($arParams["STORES"] as $pid => $arProperty){			$arStoresIds[] = $arProperty["ID"];		}					$filter = array( "ACTIVE" => "Y", "PRODUCT_ID" => $arParams["ELEMENT_ID"], "+SITE_ID" => SITE_ID, "ISSUING_CENTER" => 'Y', "ID" => $arStoresIds );		$rsProps = CCatalogStore::GetList( array('TITLE' => 'ASC', 'ID' => 'ASC'), $filter, false, false, $arSelect );		while ($prop = $rsProps->GetNext()){			$amount = (is_null($prop["PRODUCT_AMOUNT"])) ? 0 : $prop["PRODUCT_AMOUNT"];			$quantity += $amount;			$arResult["STORES"][$prop['ID']]["ADDRESS"] = $prop["ADDRESS"];			$arResult["STORES"][$prop['ID']]["SORT"] = $prop["SORT"];			$arResult["STORES"][$prop['ID']]["TITLE"] = $prop["TITLE"];			if(isset($prop["UF_METRO"]))				$arResult["STORES"][$prop['ID']]["METRO"] = unserialize($prop["UF_METRO"]);		}		unset($arResult["STORES"]);		$arResult["STORES"][0]["NUM_AMOUNT"] =$arResult["STORES"][0]["AMOUNT"] = $quantity;	}	$order = ($arParams["STORES_FILTER_ORDER"] == "SORT_ASC" ? SORT_ASC : SORT_DESC);	if($arParams["STORES_FILTER"] == "TITLE")	{		Collection::sortByColumn($arResult["STORES"], array($arParams["STORES_FILTER"] => $order));	}	else	{		Collection::sortByColumn($arResult["STORES"], array($arParams["STORES_FILTER"] => array(SORT_NUMERIC, $order), 'TITLE' => $order));	}}?>