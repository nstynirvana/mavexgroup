<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
if(\Bitrix\Main\Loader::includeModule('aspro.priority')){

	global $arTheme;
	$indexType = $arTheme["INDEX_TYPE"]["VALUE"];
	$bHideIntagramIndex = isset($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["INSTAGRAMM_INDEX"]["VALUE"]) && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["INSTAGRAMM_INDEX"]["VALUE"] === 'N';
	if($bHideIntagramIndex)
		return;
	
	if($this->startResultCache(false, array($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups(), $arParams["TOKEN"]))){
		$inst=new CInstargramPriority($arParams["TOKEN"]);
		$arResult['POSTS']=$inst->getInstagramPosts();
		$arResult['USER']['username'] = $arResult['POSTS'][0]['username'];?>

		<?if($arResult['POSTS']['ERROR'] || $arResult['POSTS']['error'] || empty($arResult['POSTS'])):?>
			<?$this->AbortResultCache();
			if($GLOBALS['USER']->IsAdmin()):?>
				<?if($arResult['POSTS']['ERROR'] === "Y" && strlen($arResult['POSTS']['MESSAGE']) > 0):?>
					<div class="alert alert-danger">
						<strong>Error:</strong> <?=( $arResult["POSTS"]["MESSAGE"] ? $arResult["POSTS"]["MESSAGE"] : GetMessage('ERROR_NO_API_KEY') )?>
					</div>
				<?elseif($arResult['POSTS']['error'] || empty($arResult['POSTS'])):?>
					<div class="alert alert-danger">
						<strong>Error:</strong> <?=( $arResult['POSTS']['error']['message'] ? $arResult['POSTS']['error']['message'] : GetMessage('ERROR_INSTAGRAM') );?>
					</div>
				<?endif;?>
			<?endif;?>
		<?endif;?>
		<?
		/*$this->setResultCacheKeys(array(
			"POSTS",
			"USER",
		));*/
		$this->IncludeComponentTemplate();
	}
}
else{
	return;
}
?>