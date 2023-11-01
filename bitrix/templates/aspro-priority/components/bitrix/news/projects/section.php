<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
// geting section items count and section [ID, NAME]
$arItemFilter = CPriority::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
$arSectionFilter = CPriority::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);

if($arParams['CACHE_GROUPS'] == 'Y')
{
	$arSectionFilter['CHECK_PERMISSIONS'] = 'Y';
	$arSectionFilter['GROUPS'] = $GLOBALS["USER"]->GetGroups();
}

$arSection = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE'), true);
CPriority::AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);

$bFoundSection = false;
$arYears = array();

if($arSection)
{
	$bFoundSection = true;
	$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
}

global $arTheme;
if($arTheme['PROJECTS_PAGE']['VALUE'] == 'list_elements_3' || $arParams["SECTION_ELEMENTS_TYPE_VIEW"] == 'list_elements_3')
{
	$arYears = CPriority::GetItemsYear($arParams);
	if($arYears)
	{
		$current_year = current($arResult['VARIABLES']);
		if($current_year && $arYears[$current_year])
		{
			$bFoundSection = true;
			$GLOBALS[$arParams["FILTER_NAME"]] = array(
				">DATE_ACTIVE_FROM" => ConvertDateTime("01.01.".$current_year, "DD.MM.YYYY"),
				"<=DATE_ACTIVE_FROM" => ConvertDateTime("01.01.".(intval($current_year)+1), "DD.MM.YYYY"),
			);
			$title_news = GetMessage('CURRENT_PROJECTS', array('#YEAR#' => $current_year));
		}
		$itemsCnt = 1;
	}
}?>
<div class="maxwidth-theme">
	<?CPriority::get_banners_position('CONTENT_TOP');?>
</div>
<?if(!$bFoundSection && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="maxwidth-theme"><div class="alert alert-warning"><?=GetMessage("SECTION_NOTFOUND")?></div></div>
<?elseif(!$bFoundSection && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CPriority::goto404Page();?>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CPriority::ShowRSSIcon(CComponentEngine::makePathFromTemplate($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss_section'], array_map('urlencode', $arResult['VARIABLES'])));
	}?>
	<?if(!$itemsCnt):?>
		<div class="maxwidth-theme"><div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div></div>
	<?endif;?>

	<?
	global $arTheme;
	if(isset($arParams["TYPE_HEAD_BLOCK"])) {
		if($arParams["TYPE_HEAD_BLOCK"]=='FROM_MODULE'){
			if($arTheme["PROJECTS_SHOW_HEAD_BLOCK"]['VALUE'] == 'N'){
				$arParams['TYPE_HEAD_BLOCK'] = 'none';
			}else{
				$arParams['TYPE_HEAD_BLOCK'] = $arTheme["PROJECTS_SHOW_HEAD_BLOCK"]["DEPENDENT_PARAMS"]["SHOW_HEAD_BLOCK_TYPE"]['VALUE'];
			}
		}
	} else {
		if($arTheme["PROJECTS_SHOW_HEAD_BLOCK"]['VALUE'] == 'N'){
			$arParams['TYPE_HEAD_BLOCK'] = 'none';
		}else{
			$arParams['TYPE_HEAD_BLOCK'] = $arTheme["PROJECTS_SHOW_HEAD_BLOCK"]["DEPENDENT_PARAMS"]["SHOW_HEAD_BLOCK_TYPE"]['VALUE'];
		}
	}
	?>
	<div class="maxwidth-theme">

		<?if($arParams['TYPE_HEAD_BLOCK']=='mix'):?>
			<div class="mixitup-container">
		<?endif;?>

		<?$sViewElementsTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["PROJECTS_PAGE"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);?>
		
		<?if($arParams['TYPE_HEAD_BLOCK'] != 'none'):?>
			<?if($sViewElementsTemplate == 'list_elements_2' || $sViewElementsTemplate == 'list_elements_5'){
				$useSections = true;
			}elseif($sViewElementsTemplate == 'list_elements_6' || $sViewElementsTemplate == 'list_elements_3'){
				$useDate = true;
			}?>
			
			<?@include_once('include/head_block.php');?>
		<?endif;?>

		<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>

		<?if($arParams['TYPE_HEAD_BLOCK']=='mix'):?>
			</div>
		<?endif;?>

	</div> <?// maxwidth-theme?>
<?endif;?>
<div class="maxwidth-theme">
	<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
</div>