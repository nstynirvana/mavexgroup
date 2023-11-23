<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
// get element
$arItemFilter = CPriority::GetCurrentElementFilter($arResult['VARIABLES'], $arParams);

global $APPLICATION, $arTheme;
$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');

$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/animation/animate.min.css');

$arElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), $arItemFilter, false, false, array('ID', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'DETAIL_PAGE_URL', 'LIST_PAGE_URL', 'PROPERTY_LINK_PROJECTS', 'PROPERTY_LINK_GOODS', 'PROPERTY_LINK_REVIEWS', 'PROPERTY_LINK_STAFF', 'PROPERTY_LINK_SERVICES'));

if($arParams["SHOW_NEXT_ELEMENT"] == "Y")
{
	$arSort=array($arParams["SORT_BY1"] => $arParams["SORT_ORDER1"], $arParams["SORT_BY2"] => $arParams["SORT_ORDER2"]);
	$arElementNext = array();

	$arAllElements = CCache::CIblockElement_GetList(array($arParams["SORT_BY1"] => $arParams["SORT_ORDER1"], $arParams["SORT_BY2"] => $arParams["SORT_ORDER2"], 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "SECTION_ID" => $arElement["IBLOCK_SECTION_ID"]/*, ">ID" => $arElement["ID"]*/ ), false, false, array('ID', 'DETAIL_PAGE_URL', 'IBLOCK_ID', 'SORT'));
	if($arAllElements)
	{
		$url_page = $APPLICATION->GetCurPage();
		$key_item = 0;
		foreach($arAllElements as $key => $arItemElement)
		{
			if($arItemElement["DETAIL_PAGE_URL"] == $url_page)
			{
				$key_item = $key;
				break;
			}
		}
		if(strlen($key_item))
		{
			$arElementNext = $arAllElements[$key_item+1];
		}
		if($arElementNext)
		{
			if($arElementNext["DETAIL_PAGE_URL"] && is_array($arElementNext["DETAIL_PAGE_URL"])){
				$arElementNext["DETAIL_PAGE_URL"]=current($arElementNext["DETAIL_PAGE_URL"]);
			}
		}
		elseif(count($arAllElements) > 1)
		{
			$arElementNext = $arAllElements[0];
		}
	}
}
//bug fix bitrix for search element
if($arElement)
{
	$strict_check = $arParams["DETAIL_STRICT_SECTION_CHECK"] === "Y";
	if(!CIBlockFindTools::checkElement($arParams["IBLOCK_ID"], $arResult["VARIABLES"], $strict_check))
		$arElement = array();
}
?>
<?if(!$arElement && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("ELEMENT_NOTFOUND")?></div>
<?elseif(!$arElement && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CPriority::goto404Page();?>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
	}?>
	<?CPriority::AddMeta(
		array(
			'og:description' => $arElement['PREVIEW_TEXT'],
			'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])) : false),
		)
	);?>
	<div class="detail <?=($templateName = $component->{'__template'}->{'__name'})?>" itemscope itemtype="http://schema.org/Service">
		<div class="col-xs-12">
			<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
				<?Aspro\Functions\CAsproPriority::showShareBlock(
					array(
						'CLASS' => 'top',
						'USE_RSS' => $arParams['USE_RSS'],
					)
				);?>
			<?endif;?>
			<?//element?>
			<?$sViewElementTemplate = ($arParams["ELEMENT_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["SERVICES_PAGE_DETAIL"]["VALUE"] : $arParams["ELEMENT_TYPE_VIEW"]);?>
			<?@include_once('page_blocks/'.$sViewElementTemplate.'.php');?>
		</div>
	</div>
	<?
	if(is_array($arElement['IBLOCK_SECTION_ID']) && count($arElement['IBLOCK_SECTION_ID']) > 1){
		CPriority::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
	}
	?>
<?endif;?>

<div style="clear:both">
</div>

<?
$bPositionMenu = $arTheme['SIDE_MENU']['VALUE'];
$bShowLeftMenu = $arTheme['SERVICES_DETAIL_LEFT_BLOCK']['VALUE'] == 'Y';?>
<div class="col-xs-12">
	<div class="row <?=$bShowLeftMenu ? '' : 'centered';?>">
		<div class="col-md-9 <?=$bShowLeftMenu  && $bPositionMenu !== "RIGHT" ? 'col-md-offset-3' : '';?>">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6 share">
					<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
						<?Aspro\Functions\CAsproPriority::showShareBlock(
							array(
								'CLASS' => 'bottom'
							)
						);?>
					<?endif;?>
				</div>
				<?
				$list_url = $arResult['FOLDER'].$arResult['URL_TEMPLATES']['news'];
				if($arElement['IBLOCK_SECTION_ID'])
				{
					$arSection = CCache::CIBlockSection_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arElement['IBLOCK_ID']), 'MULTI' => 'N')), array('ID' => $arElement['IBLOCK_SECTION_ID'], 'ACTIVE' => 'Y'), false, array('ID', 'NAME', 'SECTION_PAGE_URL'));
					if($arSection['SECTION_PAGE_URL'])
						$list_url = $arSection['SECTION_PAGE_URL'];
				}
				?>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<a class="back-url url-block font_upper" href="<?=$list_url;?>"><span><?=GetMessage('BACK_LINK')?></span></a>
				</div>
			</div>
		</div>
	</div>
</div>