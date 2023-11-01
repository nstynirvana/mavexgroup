<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(empty($arResult))
	return "";

$strReturn = '<ul class="breadcrumb" id="navigation" itemscope itemtype="http://schema.org/BreadcrumbList">';

if ($arResult[1]["LINK"] == "/product/") {
	$arResult[1]["UF_SHOW_LINK"] = 1;
	foreach ($arResult as &$arChild):
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
	$arResult[1]["UF_SHOW_LINK"] = 1;
	foreach ($arResult as &$arChild):
		$uf_name = Array("UF_SHOW_LINK");
		$code = explode("/", $arChild["LINK"]);
		$code = $code[2];
		$uf_arresult = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => 34, "CODE" => $code), false, $uf_name);
		if($uf_value = $uf_arresult->GetNext()):
			if ($uf_value["UF_SHOW_LINK"] == 1) {
				$arResult[2]["UF_SHOW_LINK"] = 1;
			}
		endif;	
	endforeach;	
}

$position = 1;
for($index = 0, $itemSize = count($arResult); $index < $itemSize; ++$index){
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if(strlen($arResult[$index]["LINK"]) && $arResult[$index]['LINK'] != GetPagePath() && $arResult[$index]['LINK']."index.php" != GetPagePath())
		if ($arResult[$index]["UF_SHOW_LINK"] == 1) {
			$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" id="bx_breadcrumb_'.$index.'"><a title="'.$index.'" itemprop="item"><span itemprop="name">'.$title.'</span></a><meta itemprop="position" content="'.$position.'" /></li>';
		}else{
			$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" id="bx_breadcrumb_'.$index.'"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item"><span itemprop="name">'.$title.'</span></a><meta itemprop="position" content="'.$position.'" /></li>';
		}
	else{
		if(empty($arResult[$index]["LINK"]))
		    $arResult[$index]["LINK"] = "#bx_breadcrumb_".$index;
		$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" id="bx_breadcrumb_'.$index.'" class="active"><link href="'.$arResult[$index]["LINK"].'" itemprop="item" /><span><span itemprop="name">'.$title.'</span></span><meta itemprop="position" content="'.$position.'" /></li>';
		break;
	}
	++$position;
}

$strReturn .= '</ul>';

return $strReturn;?>