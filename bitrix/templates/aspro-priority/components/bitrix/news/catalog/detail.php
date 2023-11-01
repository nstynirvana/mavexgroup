<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?
$this->setFrameMode(true);
if($_arResult = CPriority::CheckSmartFilterSEF($arParams, $component)){
	$arResult = $_arResult;
	include  __DIR__.'/section.php';
	return;
}

global $arTheme;
use \Bitrix\Main\Localization\Loc;
$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');

// get element
$arItemFilter = CPriority::GetCurrentElementFilter($arResult['VARIABLES'], $arParams);

global $APPLICATION;
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/animation/animate.min.css');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/sly.js');

$arElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), $arItemFilter, false, false, array('ID', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE'));
?>
<?if(!$arElement && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="maxwidth-theme"><div class="alert alert-warning"><?=GetMessage("ELEMENT_NOTFOUND")?></div></div>
<?elseif(!$arElement && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CPriority::goto404Page();?>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
	}
	?>
	<?CPriority::AddMeta(
		array(
			'og:description' => $arElement['PREVIEW_TEXT'],
			'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])) : false),
		)
	);?>
	<div class="maxwidth-theme">
		<?CPriority::get_banners_position('CONTENT_TOP');?>
	</div>
	<div class="catalog detail fixed_wrapper" itemscope itemtype="http://schema.org/Product">
		<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
			<?Aspro\Functions\CAsproPriority::showShareBlock(array(
				'CLASS' => 'top',
				'USE_RSS' => $arParams['USE_RSS'],
			));?>
		<?endif;?>

		<?$arParams["GRUPPER_PROPS"] = $arTheme["GRUPPER_PROPS"]["VALUE"];
		if($arTheme["GRUPPER_PROPS"]["VALUE"] != "NOT") {
			$arParams["PROPERTIES_DISPLAY_TYPE"] = "TABLE";

			if($arParams["GRUPPER_PROPS"] == "GRUPPER" && !\Bitrix\Main\Loader::includeModule("redsign.grupper"))
				$arParams["GRUPPER_PROPS"] = "NOT";
			if($arParams["GRUPPER_PROPS"] == "WEBDEBUG" && !\Bitrix\Main\Loader::includeModule("webdebug.utilities"))
				$arParams["GRUPPER_PROPS"] = "NOT";
			if($arParams["GRUPPER_PROPS"] == "YENISITE_GRUPPER" && !\Bitrix\Main\Loader::includeModule("yenisite.infoblockpropsplus"))
				$arParams["GRUPPER_PROPS"] = "NOT";
		}?>

		<?//element?>
		<?$sViewElementTemplate = ($arParams["ELEMENT_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["CATALOG_PAGE_DETAIL"]["VALUE"] : $arParams["ELEMENT_TYPE_VIEW"]);?>
		<?@include_once('page_blocks/'.$sViewElementTemplate.'.php');?>
		<? if ($arParams['AJAX_MODE']): ?>
			<script>
				$(function(){
					InitFlexSlider();
				})
			</script>
		<? endif; ?>
	</div>
	<?
	if(is_array($arElement['IBLOCK_SECTION_ID']) && count($arElement['IBLOCK_SECTION_ID']) > 1){
		CPriority::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
	}
	?>
<?endif;?>
<div style="clear:both"></div>
<div class="maxwidth-theme bottom_detail">
	<div class="row">
		<div class="col-md-9">
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
<div class="maxwidth-theme">
	<div class="row">
		<div class="col-md-9">
			<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
		</div>
	</div>
</div>