<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"]){
	if($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

if($arResult["NavQueryString"] != "")
{
	$arTmp = explode("&amp;", $arResult["NavQueryString"]);
	if($arTmp)
	{
		foreach($arTmp as $key => $value)
		{
			if(strpos($value, "AJAX_REQUEST") !== false)
			{
				unset($arTmp[$key]);
			}
		}
		if(!$arTmp)
			$arResult["NavQueryString"] = "";
		else
			$arResult["NavQueryString"]  = implode("&amp;", $arTmp);
	}
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

if($arResult["NavPageNomer"] == 1)
	$bPrevDisabled = true;
elseif($arResult["NavPageNomer"] < $arResult["NavPageCount"])
	$bPrevDisabled = false;
if($arResult["NavPageNomer"] == $arResult["NavPageCount"])
	$bNextDisabled = true;
else
	$bNextDisabled = false;
?>
<?if(!$bNextDisabled){?>
	<div class="ajax_load_btn_pagination">
		<span class="more_text_ajax btn btn-default btn-transparent font_upper_md"><?=GetMessage('PAGER_SHOW_MORE')?></span>
	</div>
<?}?>

<div class="wrap_pagination">
	<ul class="pagination">
		<?if($arResult["bDescPageNumbering"] === true):?>
			<?if($arResult["NavPageCount"] > $arResult["NavPageNomer"]):?>
				<?// prev?>
				<?if($arResult["NavPageCount"] - $arResult["NavPageNomer"] > 1):?>
					<?$href = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"] + 1);?>
				<?else:?>
					<?$href = $arResult["sUrlPath"].$strNavQueryStringFull;?>
				<?endif;?>
				<li class="prev"><a href="<?=$href?>"><i class="fa fa-chevron-left"></i></a></li>
				<link rel="prev" href="<?=$href?>" />
				<link rel="canonical" href="<?=$arResult["sUrlPath"]?>" />
			<?endif;?>
			<?if($arResult["NavPageCount"] > $arResult["nStartPage"]):?>
				<?// first?>
				<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
			<?endif;?>
			<?if($arResult["NavPageCount"] - ($arResult["nStartPage"]) > 2):?>
				<?// ...?>
				<li class="before"><span>...</span></li>
			<?elseif($arResult["NavPageCount"] - ($arResult["nStartPage"]) == 2):?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"] - 1?>">2</a></li>
			<?endif;?>
			<?for($i = $arResult["nStartPage"]; $i >= $arResult["nEndPage"]; --$i):?>
				<?// 2 items before current?>
				<?// current?>
				<?// 2 items after current?>
				<?if($i == $arResult["NavPageNomer"]):?>
					<li class="active"><span><?=($arResult["NavPageCount"] - $i + 1)?></span></li>
				<?else:?>
					<?if($i == $arResult["NavPageCount"]):?>
						<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
					<?else:?>
						<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$i?>"><?=($arResult["NavPageCount"] - $i + 1)?></a></li>
					<?endif;?>
				<?endif;?>
			<?endfor;?>
			<?if($arResult["nEndPage"] > 3):?>
				<?// ...?>
				<li class="before"><span>...</span></li>
			<?elseif($arResult["nEndPage"] == 3):?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=2"><?=$arResult["NavPageCount"] - 1?></a></li>
			<?endif;?>
			<?if($arResult["nEndPage"] > 1):?>
				<?// last?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=$arResult["NavPageCount"]?></a></li>
			<?endif;?>
			<?if($arResult["NavPageNomer"] > 1):?>
				<?// next?>
				<?$href = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"] - 1);?>
				<li class="next"><a href="<?=$href?>"><i class="fa fa-chevron-right"></i></a></li>
				<link rel="next" href="<?=$href?>" />
			<?endif;?>
		<?else:?>
			<?if($arResult["NavPageNomer"] > 1):?>
				<?// prev?>
				<?if($arResult["NavPageNomer"] > 2):?>
					<?$href = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"] - 1);?>
				<?else:?>
					<?$href = $arResult["sUrlPath"].$strNavQueryStringFull;?>
				<?endif;?>
				<li class="prev"><a href="<?=$href?>"><i class="fa fa-chevron-left"></i></a></li>
				<link rel="prev" href="<?=$href?>" />
				<link rel="canonical" href="<?=$arResult["sUrlPath"]?>" />
			<?endif;?>
			<?if($arResult["nStartPage"] > 1):?>
				<?// first?>
				<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
			<?endif;?>
			<?if(($arResult["nStartPage"] - 1) > 2):?>
				<?// ...?>
				<li class="before"><span>...</span></li>
			<?elseif(($arResult["nStartPage"] - 1) == 2):?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=2">2</a></li>
			<?endif;?>
			<?for($i = $arResult["nStartPage"]; $i <= $arResult["nEndPage"]; ++$i):?>
				<?// 2 items before current?>
				<?// current?>
				<?// 2 items after current?>
				<?if($i == $arResult["NavPageNomer"]):?>
					<li class="active"><span><?=$i?></span></li>
				<?else:?>
					<?if($i == 1):?>
						<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
					<?else:?>
						<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$i?>"><?=$i?></a></li>
					<?endif;?>
				<?endif;?>
			<?endfor;?>
			<?if($arResult["NavPageCount"] - $arResult["nEndPage"] > 2):?>
				<?// ...?>
				<li class="before"><span>...</span></li>
			<?elseif(($arResult["NavPageCount"] - $arResult["nEndPage"]) == 2):?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"] - 1?>"><?=$arResult["NavPageCount"] -1?></a></li>
			<?endif;?>
			<?if($arResult["nEndPage"] < $arResult["NavPageCount"]):?>
				<?// last?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a></li>
			<?endif;?>
			<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
				<?// next?>
				<?$href = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"] + 1);?>
				<li class="next"><a href="<?=$href?>"><i class="fa fa-chevron-right"></i></a></li>
				<link rel="next" href="<?=$href?>" />
			<?endif;?>
		<?endif;?>
		<?if($arResult["bShowAll"]):?>
			<!-- noindex -->
				<?if($arResult["NavShowAll"]):?>
					<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a></li>
				<?else:?>
					<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a></li>
				<?endif?>
			<!-- /noindex -->
		<?endif?>
	</ul>
</div>