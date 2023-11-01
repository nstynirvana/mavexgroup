<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?// intro text?>
<div class="maxwidth-theme">
	<?CPriority::get_banners_position('CONTENT_TOP');?>

	<div class="text_before_items"><!--
		--><?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "page",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => ""
			)
		);?><!--
	--></div>
</div>
<?
$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);

if($arParams['CACHE_GROUPS'] == 'Y')
{
	$arItemFilter['CHECK_PERMISSIONS'] = 'Y';
	$arItemFilter['GROUPS'] = $GLOBALS["USER"]->GetGroups();
}

$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());?>

<?if(!$itemsCnt):?>
	<div class="maxwidth-theme"><div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div></div>
<?else:?>
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
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N')
		CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
	?>
	<div class="maxwidth-theme">

	<?$sViewElementsTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["PROJECTS_PAGE"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);?>

	<?if($arParams['TYPE_HEAD_BLOCK']=='mix'):?>
		<div class="mixitup-container">
	<?endif;?>

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