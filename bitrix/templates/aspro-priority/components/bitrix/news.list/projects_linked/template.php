<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>

<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views news-items projects type_1 front linked fixed">
		<?
		global $arTheme;
		$slideshowSpeed = abs(intval(CPriority::GetFrontParametrValue('PARTNERSBANNER_SLIDESSHOWSPEED')));
		$animationSpeed = abs(intval(CPriority::GetFrontParametrValue('PARTNERSBANNER_ANIMATIONSPEED')));
		$bAnimation = (bool)$slideshowSpeed;
		$isNormalBlock = (isset($arParams['NORMAL_BLOCK']) && $arParams['NORMAL_BLOCK'] == 'Y');
		//$col_sm = ($arParams['NEWS_COUNT'] > 3 ? );
		?>
		<div class="flexslider unstyled dark-nav" data-plugin-options='{"itemMargin": 32, "directionNav": true, "controlNav" :false, "animationLoop": true, <?=($bAnimation ? '"slideshow": true,' : '"slideshow": false,')?> <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "counts": [2, 2, 2, 1]}'>
			<ul class="slides items">
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
					
					// text color
					$textColor = (isset($arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']) && $arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID'] : '');
					?>
					<li class="item clearfix<?=(!$bImage ? ' wti' : '')?><?=($textColor ? ' '.$textColor : '')?> col-md-6 col-sm-6 col-xs-12">
						<div class="wrap" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<?if($imageSrc):?>
								<div class="image<?=($bImage ? "" : " wti" );?>">
									<div class="wrap" style="background:url(<?=$imageSrc?>) top center / cover no-repeat!important;"></div>
								</div>
							<?endif;?>
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
					</li>
				<?endforeach;?>
			</ul>
		</div>
	</div>
<?endif;?>