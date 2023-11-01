<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>

<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views news-items projects type_1 front projects_list">
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<div class="pagination_nav">
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>

		<?
		$bHasSection = false;
		if($arParams['PARENT_SECTION'] && (isset($arResult['SECTIONS']) && $arResult['SECTIONS']))
		{
			if(isset($arResult['SECTIONS'][$arParams['PARENT_SECTION']]) && $arResult['SECTIONS'][$arParams['PARENT_SECTION']])
				$bHasSection = true;
		}
		if($bHasSection)
		{
			// edit/add/delete buttons for edit mode
			$arSectionButtons = CIBlock::GetPanelButtons($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['IBLOCK_ID'], 0, $arResult['SECTIONS'][$arParams['PARENT_SECTION']]['ID'], array('SESSID' => false, 'CATALOG' => true));
			$this->AddEditAction($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['IBLOCK_ID'], 'SECTION_EDIT'));
			$this->AddDeleteAction($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="section" id="<?=$this->GetEditAreaId($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['ID'])?>">
			<?
		}?>
			<div class="items row flexbox">
				<?$index = 1;?>
				<?foreach($arResult['ITEMS'] as $i => $arItem):?>
					<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					// use detail link?
					$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
					// preview image
					$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
					$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : '');

					// show active date period
					$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));

					// big block
					$bBigBlock = ($index == 1 || $index == 6 ? true : false);//(isset($arItem['DISPLAY_PROPERTIES']['BIG_BLOCK']) && $arItem['DISPLAY_PROPERTIES']['BIG_BLOCK']['VALUE_XML_ID'] == 'Y' ? true : false);

					// text color
					$textColor = (isset($arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']) && $arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID'] : '');
					?>
					<div class="item clearfix<?=($bBigBlock ? ' big_block' : '')?><?=(!$bImage ? ' wti' : '')?><?=($textColor ? ' '.$textColor : '')?> col-md-<?=($bBigBlock ? 6 : 3)?> col-sm-4 col-xs-6 <?=$arResult['SECTIONS_ELEMENTS'][$arItem['ID']]?> <?=$arItem['FILTER_DATE']?>" data-ref="mixitup-target">
						<div class="wrap shadow" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="image<?=($bImage ? "" : " wti" );?>">
								<?if($imageSrc):?>
									<div class="wrap" style="background:url(<?=$imageSrc?>) top center / cover no-repeat;"></div>
								<?endif;?>
							</div>
							<div class="body-info">
								<?// section title?>
								<?if(strlen($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']) && !((isset($arItem['SOCIAL_PROPS']) && $arItem['SOCIAL_PROPS']))):?>
									<div class="section_name"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']?></div>
								<?endif;?>

								<?// element name?>
								<?if(strlen($arItem['FIELDS']['NAME'])):?>
									<div class="title"><?=$arItem['NAME']?></div>
								<?endif;?>

								<?// element preview text?>
								<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT']) && !$bImage):?>
									<div class="previewtext">
										<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
											<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
										<?else:?>
											<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
										<?endif;?>
									</div>
								<?endif;?>

								<?// date active period?>
								<?if($bActiveDate):?>
									<div class="period">
										<?if(strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
											<span class="date font_xs"><?=$arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
										<?else:?>
											<span class="date font_xs"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
										<?endif;?>
									</div>
								<?endif;?>
							</div>
							<?if($bDetailLink):?>
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
							<?endif;?>
						</div>
					</div>
					<?
					$index = ($index == 6 ? 0 : $index);
					++$index;
					?>
				<?endforeach;?>
			</div>
		<?if($bHasSection):?>
			</div>
		<?endif;?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<div class="pagination_nav">
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
	</div>
<?endif;?>