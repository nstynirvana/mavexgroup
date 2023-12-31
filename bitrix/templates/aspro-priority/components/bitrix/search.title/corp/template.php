<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);
$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

global $arTheme;
$searchType1 = (isset($arTheme['TYPE_SEARCH']['VALUE']) && $arTheme['TYPE_SEARCH']['VALUE'] == 'corp' || $arTheme['TYPE_SEARCH'] == 'corp' ? ' corp_search' : '');
?>
<?if($arParams["SHOW_INPUT"] !== "N"):?>
	<?if($searchType1):?>
		<span class="close-block inline-search-hide search_type_1">
			<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
		</span>
	<?endif;?>
	<?if($arParams["SHOW_INPUT_FIXED"] != "Y"):?>
		<div class="inline-search-block with-close fixed big show_center">
			<div class="maxwidth-theme">
				<div class="col-md-12">
	<?endif;?>
			<div class="search-wrapper">
				<div id="<?=$CONTAINER_ID?>">
					<form action="<?=$arResult["FORM_ACTION"]?>" class="search">
						<div class="search-input-div">
							<input class="search-input" id="<?=$INPUT_ID?>" type="text" name="q" value="" placeholder="<?=GetMessage("CT_BST_SEARCH_BUTTON_TITLE2")?>" autocomplete="off" />
						</div>
						<div class="search-button-div">
							<button class="btn btn-search" type="submit" name="s" value="<?=GetMessage("CT_BST_SEARCH_BUTTON_TITLE2")?>"><?=GetMessage("CT_BST_SEARCH_BUTTON_TITLE2")?><i class="svg svg-search svg-black"></i></button>
							<?if(!$searchType1):?>
								<span class="close-block inline-search-hide">
									<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
								</span>
							<?endif;?>
						</div>
					</form>
				</div>
			</div>
	<?if($arParams["SHOW_INPUT_FIXED"] != "Y"):?>
				</div>
			</div>
		</div>
	<?endif;?>
<?endif;?>
<script type="text/javascript">
	var jsControl = new JCTitleSearch2({
		//'WAIT_IMAGE': '/bitrix/themes/.default/images/wait.gif',
		'AJAX_PAGE' : '<?=CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
		'CONTAINER_ID': '<?=$CONTAINER_ID?>',
		'INPUT_ID': '<?=$INPUT_ID?>',
		'MIN_QUERY_LEN': 2
	});
</script>