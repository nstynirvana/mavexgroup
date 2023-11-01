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

$arElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), $arItemFilter, false, false, array('ID', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PROPERTY_FILTER_URL', 'PROPERTY_SECTION', 'PROPERTY_FORM_QUESTION'));
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
	}
	?>
	<?CPriority::AddMeta(
		array(
			'og:description' => $arElement['PREVIEW_TEXT'],
			'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])) : false),
		)
	);?>
	<div class="catalog detail landings fixed_wrapper<?=($arElement['PROPERTY_FORM_QUESTION_VALUE'] != 'Y' ? ' wtquestion' : '')?>" itemscope itemtype="http://schema.org/Product">
		<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
			<?Aspro\Functions\CAsproPriority::showShareBlock(
				array(
					'CLASS' => 'top',
					'USE_RSS' => $arParams['USE_RSS'],
				)
			);?>
		<?endif;?>
		<?//element?>
		<?@include_once('page_blocks/'.$arParams["ELEMENT_TYPE_VIEW"].'.php');?>
		<div class="row back_wrap">
			<div class="col-md-<?=($arElement['PROPERTY_FORM_QUESTION_VALUE'] == 'Y' ? '9' : '12');?>">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6 share">
						<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
							<?Aspro\Functions\CAsproPriority::showShareBlock(array('CLASS' => 'bottom'));?>
						<?endif;?>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<a class="back-url url-block font_upper" href="<?=$arResult['FOLDER'].$arResult['URL_TEMPLATES']['news']?>"><span><?=GetMessage('BACK_LINK')?></span></a>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<?
	if(is_array($arElement['IBLOCK_SECTION_ID']) && count($arElement['IBLOCK_SECTION_ID']) > 1){
		CPriority::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
	}
	?>
<?endif;?>
<div style="clear:both"></div>
