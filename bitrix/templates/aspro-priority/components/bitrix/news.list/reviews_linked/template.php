<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views front reviews linked">
			<?
			$qntyItems = count($arResult['ITEMS']);

			global $arTheme;
			$slideshowSpeed = abs(intval(CPriority::GetFrontParametrValue('PARTNERSBANNER_SLIDESSHOWSPEED')));
			$animationSpeed = abs(intval(CPriority::GetFrontParametrValue('PARTNERSBANNER_ANIMATIONSPEED')));
			$bAnimation = (bool)$slideshowSpeed;
			?>
			<div class="flexslider unstyled row navigation-vcenter dark-nav" data-plugin-options='{"directionNav": true, "controlNav" :true, "animationLoop": true, "slideshow": false, <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "counts": [1, 1, 1]}'>
				<ul class="slides items">
					<?foreach($arResult['ITEMS'] as $i => $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						// use detail link?
						$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
						$name = (isset($arItem['DISPLAY_PROPERTIES']['NAME']) && strlen($arItem['DISPLAY_PROPERTIES']['NAME']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['NAME']['VALUE'] : $arItem['NAME']);
						// preview image
						$bLogo = false;
						$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
						$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 80, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
						$imageSrc = ($bImage ? $arImage['src'] : '');
						
						if(!$imageSrc && strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC'])){
							$bImage = strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC']);
							$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['DETAIL_PICTURE']['ID'], array('width' => 90, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
							$imageSrc = ($bImage ? $arImage['src'] : '');
							$bLogo = ($imageSrc ? true : false);
						}
						?>
						<li class="col-md-12">
							<div class="item border shadow clearfix<?=($bImage ? '' : ' wti')?><?=($bLogo ? ' wlogo' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<div class="wrap">
									<div class="top_wrappe
									r">
										<?if($imageSrc):?>
											<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
												<div class="image">
													<div class="wrap">
													<?if($imageSrc):?>
														<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
													<?endif;?>
													</div>
												</div>
											<?if($bDetailLink):?></a><?endif;?>
										<?endif;?>
										<div class="top-info">
											<div class="wrap">
												<?if(isset($arItem['DISPLAY_PROPERTIES']['POST']) && strlen($arItem['DISPLAY_PROPERTIES']['POST']['VALUE'])):?>
													<span class="font_upper"><?=$arItem['DISPLAY_PROPERTIES']['POST']['VALUE']?></span>
												<?endif?>
												<?if(isset($arItem['DISPLAY_ACTIVE_FROM']) && $arItem['DISPLAY_ACTIVE_FROM']):?>
													<span class="separator">&ndash;</span>
													<span class="date font_upper"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
												<?endif;?>
												<?if(in_array('RATING', $arParams['PROPERTY_CODE'])):?>
													<?
													$ratingValue = ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] : 0);
													?>
													<div class="rating_wrap pull-right clearfix">
														<div class="rating current_<?=$ratingValue?>">
															<span class="stars_current"></span>
														</div>
													</div>
												<?endif;?>
											</div>
											<div class="title">
												<?=$name?>
											</div>
										</div>
									</div>
									
									<div class="body-info">
										<?if(isset($arItem['DISPLAY_PROPERTIES']['RATING'])):?>
											<?
											$ratingValue = ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] : 0);
											?>
											<div class="rating_wrap media clearfix">
												<div class="rating current_<?=$ratingValue?>">
													<span class="stars_current"></span>
												</div>
											</div>
										<?endif;?>
										
										<div class="clearfix"></div>
									</div>
									<?if(isset($arItem['DISPLAY_PROPERTIES']['MESSAGE']) && strlen($arItem['DISPLAY_PROPERTIES']['MESSAGE']['DISPLAY_VALUE'])):?>
										<div class="preview-text"><?=CPriority::truncateLengthText($arItem['DISPLAY_PROPERTIES']['MESSAGE']['DISPLAY_VALUE'], $arParams['PREVIEW_TRUNCATE_LEN']);?></div>
										<?if(strlen($arParams['PREVIEW_TRUNCATE_LEN']) && strlen($arItem['DISPLAY_PROPERTIES']['MESSAGE']['DISPLAY_VALUE']) > $arParams['PREVIEW_TRUNCATE_LEN']):?>
											<div class="link-block-more">
												<span class="btn btn-default btn-transparent btn-xs animate-load" data-event="jqm" data-param-id="<?=$arItem['ID'];?>" data-param-type="review" data-name="review"><?=Loc::getMessage('MORE_REVIEW');?></span>
											</div>
										<?endif;?>
									<?endif;?>
								</div>
							</div>
						</li>
					<?endforeach;?>
				</ul>
			</div>
	</div>
<?endif;?>