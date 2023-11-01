<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>

<?
$bShowAskBlock = ($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES');
$bShowOrderBlock = ($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES');
$bShowAllChar = (isset($arResult['DISPLAY_PROPERTIES_FORMATTED']) && count($arResult['DISPLAY_PROPERTIES_FORMATTED'])>3);
$catalogLinkedTemplate = (isset($arTheme['ELEMENTS_TABLE_TYPE_VIEW']) && $arTheme['ELEMENTS_TABLE_TYPE_VIEW']['VALUE'] == 'catalog_table_2' ? 'catalog_linked_2' : 'catalog_linked');

/*set array props for component_epilog*/
$templateData = array(
	'DOCUMENTS' => (array)$arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE'],
	'LINK_SALE' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_SALE']['VALUE'],
	'LINK_FAQ' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_FAQ']['VALUE'],
	'LINK_PROJECTS' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_PROJECTS']['VALUE'],
	'LINK_SERVICES' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_SERVICES']['VALUE'],
	'LINK_GOODS' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_GOODS']['VALUE'],
	'LINK_PARTNERS' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_PARTNERS']['VALUE'],
	'LINK_SERTIFICATES' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_SERTIFICATES']['VALUE'],
	'LINK_VACANCYS' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_VACANCYS']['VALUE'],
	'LINK_STAFF' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_STAFF']['VALUE'],
	'LINK_REVIEWS' => (array)$arResult['DISPLAY_PROPERTIES']['LINK_REVIEWS']['VALUE'],
	'BRAND_ITEM' => (array)$arResult['BRAND_ITEM'],
	'GALLERY_BIG' => (array)$arResult['GALLERY_BIG'],
	'VIDEO' => (array)$arResult['VIDEO'],
	'VIDEO_IFRAME' => (array)$arResult['VIDEO_IFRAME'],
	'DETAIL_TEXT' => $arResult['FIELDS']['DETAIL_TEXT'],
	'PREVIEW_TEXT' => $arResult['FIELDS']['PREVIEW_TEXT'],
	'ORDER' => $bOrderViewBasket,
	'FORM_QUESTION' => $arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE'],
	'FORM_ORDER' => $arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE'],
	'CATALOG_LINKED_TEMPLATE' => $catalogLinkedTemplate,
	'GALLERY_TYPE' => isset($arResult['PROPERTIES']['GALLERY_TYPE']) ? ($arResult['PROPERTIES']['GALLERY_TYPE']['VALUE'] === 'small' ? 'small' : 'big') : ($arParams['GALLERY_TYPE'] === 'small' ? 'small' : 'big'),
);

$bTopImage = ($arResult['DISPLAY_PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'TOP' && isset($arResult['FIELDS']['DETAIL_PICTURE']) && $arResult['FIELDS']['DETAIL_PICTURE'] ? true : false);

if(isset($arResult['PROPERTIES']['BNR_TOP']) && $arResult['PROPERTIES']['BNR_TOP']['VALUE_XML_ID'] == 'YES')
	$templateData['SECTION_BNR_CONTENT'] = true;
?>

<?// shot top banners start?>
<?$bShowTopBanner = (isset($arResult['SECTION_BNR_CONTENT'] ) && $arResult['SECTION_BNR_CONTENT'] == true);?>
<?if($bShowTopBanner):?>
	<?$this->SetViewTarget("section_bnr_content");?>
		<?CPriority::ShowTopDetailBanner($arResult, $arParams, 'aspro_priority_order_project');?>
	<?$this->EndViewTarget();?>
<?endif;?>
<?// shot top banners end?>

<div class="item project greyline<?=(!$arResult['GALLERY'] ? ' wti' : '')?><?=($bTopImage ? ' wtop_image' : '')?>">
	<?if($bTopImage || !$arResult['GALLERY']):?>
		<?if($bTopImage):?>
			<div class="top_image" style="background:url(<?=$arResult['DETAIL_PICTURE']['SRC'];?>) top center / cover no-repeat;"></div>
		<?endif;?>
		<div class="maxwidth-theme">
			<div class="info wti" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<?if($arResult['DISPLAY_PROPERTIES_FORMATTED'] || ($bShowAskBlock || $bShowOrderBlock)):?>
					<div class="row flexbox">
						<div class="left_block col-md-<?=($bShowAskBlock || $bShowOrderBlock ? '9' : '12')?> col-sm-<?=($bShowAskBlock || $bShowOrderBlock ? '8' : '12')?> col-xs-<?=($bShowAskBlock || $bShowOrderBlock ? '7' : '12')?>">
							<?if(isset($arResult['DISPLAY_PROPERTIES']['DATA'])):?>
								<div class="date font_upper"><?=$arResult['DISPLAY_PROPERTIES_FORMATTED']['DATA']['VALUE']?></div>
							<?endif;?>
							<?if(isset($arResult['PROPERTIES']['TASK_PROJECT']['~VALUE']['TEXT']) && $arResult['PROPERTIES']['TASK_PROJECT']['~VALUE']['TEXT']):?>
								<div class="task"><?=$arResult['PROPERTIES']['TASK_PROJECT']['~VALUE']['TEXT'];?></div>
							<?endif;?>
							<?if($arResult['DISPLAY_PROPERTIES_FORMATTED']):?>
								<div class="properties">
									<?foreach($arResult['DISPLAY_PROPERTIES_FORMATTED'] as $code => $arProp):?>
										<?
										if($code == 'DATA' || $arProp['PROPERTY_TYPE'] == 'E' || $arProp['PROPERTY_TYPE'] == 'G')
											continue;
										?>
										<div class="property">
											<div class="title-prop font_upper"><?=$arProp['NAME']?></div>
											<div class="value">
												<?if(is_array($arProp['DISPLAY_VALUE'])):?>
													<?foreach($arProp['DISPLAY_VALUE'] as $key => $value):?>
														<?if($arProp['DISPLAY_VALUE'][$key + 1]):?>
															<?=$value.'&nbsp;/ '?>
														<?else:?>
															<?=$value?>
														<?endif;?>
													<?endforeach;?>
												<?elseif( strpos($arProp['DISPLAY_VALUE'], "http") || strpos($arProp['DISPLAY_VALUE'], "https") ):?>
													<?=( str_replace('<a', '<a target="_blank"', $arProp['DISPLAY_VALUE']) );?>
												<?else:?>
													<?=$arProp['DISPLAY_VALUE']?>
												<?endif;?>
											</div>
										</div>
									<?endforeach;?>
								</div>
							<?endif;?>
						</div>
						<?if($bShowAskBlock || $bShowOrderBlock):?>
							<div class="right_block col-md-3 col-sm-4 col-xs-5">
								<div class="buttons-block">
									<div class="wrap">
										<?if($bShowOrderBlock):?>
											<div class="button">
												<span class="btn btn-default btn-lg animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_order_project")?>" data-name="order_services" data-autoload-service="<?=CPriority::formatJsName($arResult['NAME'])?>" data-autoload-project="<?=CPriority::formatJsName($arResult['NAME'])?>"><span><?=(strlen($arParams['S_ORDER_PROJECT']) ? $arParams['S_ORDER_PROJECT'] : Loc::getMessage('S_ORDER_PROJECT'))?></span></span>
											</div>
										<?endif;?>
										<?if($bShowAskBlock):?>
											<div class="button">
												<span class="btn btn-default btn-lg btn-transparent animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-autoload-need_product="<?=CPriority::formatJsName($arResult['NAME'])?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : Loc::getMessage('S_ASK_QUESTION'))?></span></span>
											</div>
										<?endif;?>
									</div>
								</div>
							</div>
						<?endif;?>
					</div>
				<?endif;?>
			</div>
		</div>
	<?elseif($arResult['GALLERY']):?>
		<div class="head-block">
			<div class="row flexbox">
				<div class="col-md-6 item info_wrap">
					<div class="info wti" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
						<?if($arResult['DISPLAY_PROPERTIES_FORMATTED'] || ($bShowAskBlock || $bShowOrderBlock) || $arResult['PROPERTIES']['TASK_PROJECT']):?>
							<div class="row">
								<div class="col-md-12">
									<?if(isset($arResult['DISPLAY_PROPERTIES']['DATA'])):?>
										<div class="date font_upper"><?=$arResult['DISPLAY_PROPERTIES_FORMATTED']['DATA']['VALUE']?></div>
									<?endif;?>
									<?if(isset($arResult['PROPERTIES']['TASK_PROJECT']['~VALUE']['TEXT']) && $arResult['PROPERTIES']['TASK_PROJECT']['~VALUE']['TEXT']):?>
										<div class="task"><?=$arResult['PROPERTIES']['TASK_PROJECT']['~VALUE']['TEXT'];?></div>
									<?endif;?>
									<?if($arResult['DISPLAY_PROPERTIES_FORMATTED']):?>
										<div class="properties">
											<?foreach($arResult['DISPLAY_PROPERTIES_FORMATTED'] as $code => $arProp):?>
												<?
												if($code == 'DATA' || $arProp['PROPERTY_TYPE'] == 'E' || $arProp['PROPERTY_TYPE'] == 'G')
													continue;
												?>
												<div class="property">
													<div class="title-prop font_upper"><?=$arProp['NAME']?></div>
													<div class="value">
														<?if(is_array($arProp['DISPLAY_VALUE'])):?>
															<?foreach($arProp['DISPLAY_VALUE'] as $key => $value):?>
																<?if($arProp['DISPLAY_VALUE'][$key + 1]):?>
																	<?=$value.'&nbsp;/ '?>
																<?else:?>
																	<?=$value?>
																<?endif;?>
															<?endforeach;?>
														<?elseif( strpos($arProp['DISPLAY_VALUE'], "http") || strpos($arProp['DISPLAY_VALUE'], "https") ):?>
															<?=( str_replace('<a', '<a target="_blank"', $arProp['DISPLAY_VALUE']) );?>
														<?else:?>
															<?=$arProp['DISPLAY_VALUE']?>
														<?endif;?>
													</div>
												</div>
											<?endforeach;?>
										</div>
									<?endif;?>
								</div>
								<?if($bShowAskBlock || $bShowOrderBlock):?>
									<div class="col-md-12">
										<div class="buttons-block">
											<div class="wrap">
												<?if($bShowOrderBlock):?>
													<div class="button">
														<span class="btn btn-default btn-lg animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_order_project")?>" data-name="order_services" data-autoload-service="<?=CPriority::formatJsName($arResult['NAME'])?>" data-autoload-project="<?=CPriority::formatJsName($arResult['NAME'])?>"><span><?=(strlen($arParams['S_ORDER_PROJECT']) ? $arParams['S_ORDER_PROJECT'] : Loc::getMessage('S_ORDER_PROJECT'))?></span></span>
													</div>
												<?endif;?>
												<?if($bShowAskBlock):?>
													<div class="button">
														<span class="btn btn-default btn-lg btn-transparent animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-autoload-need_product="<?=CPriority::formatJsName($arResult['NAME'])?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : Loc::getMessage('S_ASK_QUESTION'))?></span></span>
													</div>
												<?endif;?>
											</div>
										</div>
									</div>
								<?endif;?>
							</div>
						<?endif;?>
					</div>
				</div>
				<div class="gallery_wrap col-md-6 pull-right item">
					<div class="inner items">
						<div class="flexslider color-controls dark-nav show-nav-controls" data-plugin-options='{"smoothHeight": true, "animation": "slide", "directionNav": true, "controlNav": true, "animationLoop": true, "slideshow": false, "counts": [1, 1, 1]}'>
							<ul class="slides items">
								<?$countAll = count($arResult['GALLERY']);?>
								<?foreach($arResult['GALLERY'] as $i => $arPhoto):?>
									<li class="item">
										<div class="wrap" style="background:url(<?=$arPhoto['PREVIEW']['src'];?>) center top /cover no-repeat!important;">
											<a href="<?=$arPhoto['DETAIL']['SRC']?>" target="_blank" title="<?=$arPhoto['TITLE']?>" class="fancybox" data-fancybox-group="gallery">
												<span class="zoom">
													<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/zoom.svg');?>
												</span>
											</a>
										</div>
									</li>
								<?endforeach;?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?endif;?>
</div>