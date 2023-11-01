<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<?
	global $arTheme;
	$bOrderViewBasket = $arParams['ORDER_VIEW'];
	$basketURL = (isset($arTheme['URL_BASKET_SECTION']) && strlen(trim(CPriority::GetFrontParametrValue('URL_BASKET_SECTION'))) ? CPriority::GetFrontParametrValue('URL_BASKET_SECTION') : SITE_DIR.'cart/');
	?>
	<div class="item-views tarifs wicons type_4 tarifs_scroll linked">
		<?//items?>
		<div class="items unstyled front dark-nav view-control navigation-vcenter" data-plugin-options='{"useCSS": false, "directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, "counts": [4, 3, 2, 1], "itemMargin": 0}'>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$dataItem = ($bOrderViewBasket ? CPriority::getDataItem($arItem) : false);
				$bPreviewText = (isset($arItem['FIELDS']['PREVIEW_TEXT']) && strlen($arItem['FIELDS']['PREVIEW_TEXT']) ? true : false);
				$bProperties = (isset($arItem['CHARACTERISTICS']) && $arItem['CHARACTERISTICS'] ? true : false);
				$bIcon = (isset($arItem['DISPLAY_PROPERTIES']['ICON']) && $arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'] ? true : false);
				$bBgIcon = (isset($arItem['PROPERTIES']['BACKGROUND']) && $arItem['PROPERTIES']['BACKGROUND']['VALUE_XML_ID'] == 'Y' ? true : false);
				?>
				<div class="item border shadow<?=!$bIcon ? ' wti' : ''?><?=($bBgIcon ? ' wbg' : '');?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?>>
					<div class="wrap">
						<div class="row">
							<div class="left_block">
								<div class="top_block_wrap col-md-4 col-sm-4">
									<div class="top_block clearfix">
										<?if($bIcon):?>
											<div class="image">
												<div class="wrap">
													<?
													$arImage = CFile::ResizeImageGet($arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'] , array('width' => 40, 'height' => 40), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
													?>
													<img class="img-responsive" src="<?=$arImage['src'];?>" alt="<?=$arItem['NAME'];?>" title="<?=$arItem['NAME'];?>">
												</div>
											</div>
										<?endif;?>
										<div class="right_block">
											<?if(isset($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']])):?>
												<div class="section_name font_upper"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME'];?></div>
											<?endif;?>
											<?if(isset($arItem['FIELDS']['NAME']) && strlen($arItem['FIELDS']['NAME'])):?>
												<div class="name"><?=$arItem['FIELDS']['NAME'];?></div>
											<?endif;?>
											<?if($arItem['DISPLAY_PROPERTIES']['HIT']['VALUE']):?>
												<div class="stickers">
													<div class="stickers-wrapper">
														<?foreach($arItem['DISPLAY_PROPERTIES']['HIT']['VALUE_XML_ID'] as $key => $class):?>
															<div class="sticker_<?=strtolower($class);?>"><?=$arItem['PROPERTIES']['HIT']['VALUE'][$key]?></div>
														<?endforeach;?>
													</div>
												</div>
											<?endif;?>													
										</div>
									</div>
									<?if($bPreviewText):?>
										<div class="previewtext font_xs"><?=$arItem['FIELDS']['PREVIEW_TEXT'];?></div>
									<?endif;?>
								</div>
								<div class="properties_wrap col-md-5 col-sm-5">
									<?if($bProperties):?>
										<div class="properties">
											<?$i = 0;?>
											<?foreach($arItem['CHARACTERISTICS'] as $arProp):?>
												<div class="property <?=($arParams['SHOW_PROPS_NAME'] == 'N' ? 'ntitle' : '');?> font_xs clearfix">
													<?if($arParams['SHOW_PROPS_NAME'] != 'N'):?>
														<div class="title-prop pull-left"><?=$arProp['NAME'];?></div>
													<?endif;?>
													<?if($arProp['VALUE_XML_ID'] == 'Y'):?>
														<div class="value yes pull-right"><span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/tariff_yes.svg');?></span></div>
													<?elseif($arProp['VALUE_XML_ID'] == 'N'):?>
														<div class="value no pull-right"><span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/tariff_no.svg');?></span></div>
													<?else:?>
														<div class="value pull-right">
															<?if(is_array($arProp['VALUE'])):?>
																<?implode(', ', $arProp['VALUE']);?>
															<?else:?>
																<?=$arProp['VALUE'];?>
															<?endif;?>
														</div>
													<?endif;?>
												</div>
												<?if($i == $arParams['COUNT_SHOW_PROPRERTIES'] - 1 && count($arItem['CHARACTERISTICS']) > $arParams['COUNT_SHOW_PROPRERTIES']):?>
													<div class="hidden-block">
														<div class="wrap">
												<?endif;?>
												<?++$i;?>
											<?endforeach;?>
											<?if(count($arItem['CHARACTERISTICS']) > $arParams['COUNT_SHOW_PROPRERTIES']):?>
													</div>
												</div>
												<div class="rolldown font_upper"><span data-open_text="<?=Loc::getMessage('OPEN_TEXT');?>" data-close_text="<?=Loc::getMessage('CLOSE_TEXT');?>"><span class="text"><?=Loc::getMessage('CLOSE_TEXT');?></span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/v_roller.svg');?></span></div>
											<?endif;?>
										</div>
									<?endif;?>
								</div>
							</div>
							<?
							$bDefaultPrice = (isset($arItem['DEFAULT_PRICE']) ? true : false);
							$bAllPrices = (isset($arItem['PRICES']) ? true : false);
							$bShowAllPrices = ($bAllPrices && count($arItem['PRICES']) > 1 ? true : false);
							$bOnlyOnePrice = (isset($arItem['DISPLAY_PROPERTIES']['ONLY_ONE_PRICE']) && $arItem['DISPLAY_PROPERTIES']['ONLY_ONE_PRICE']['VALUE_XML_ID'] == 'Y' ? true : false);
							$defaultPrice = ($bDefaultPrice ? $arItem['DEFAULT_PRICE']['VALUE'] : $arItem['PRICES'][0]['VALUE']);
							$defaultFilterPrice = ($bDefaultPrice ? $arItem['DEFAULT_PRICE']['FILTER_PRICE'] : $arItem['FILTER_PRICES'][0]);
							?>

							<div class="buy_block_wrap col-md-3 col-sm-3 col-xs-4">
								<?if($bAllPrices):?>
									<?if($bOnlyOnePrice):?>
										<div class="prices">
											<div class="price_default">
												<div class="value" data-price="<?=$defaultPrice;?>" data-filter_price="<?=$defaultFilterPrice;?>"><?=$defaultPrice;?></div>
											</div>
										</div>
									<?else:?>
										<div class="prices">
											<div class="price_default<?=($bShowAllPrices ? ' wdropdown' : '');?>">
												<div class="title-price"><span><span><?=($bDefaultPrice ? $arItem['DEFAULT_PRICE']['NAME'] : $arItem['PRICES'][0]['NAME'])?></span></span></div>
												<div class="value" data-price="<?=$defaultPrice;?>" data-filter_price="<?=$defaultFilterPrice;?>"><?=$defaultPrice;?></div>
											</div>
											<?if($bShowAllPrices):?>
												<ul class="all_price dropdown">
													<?foreach($arItem['PRICES'] as $keyPrice => $arPrice):?>
														<li class="price font_xs" data-price="<?=$arPrice['VALUE'];?>" data-filter_price="<?=$arItem['FILTER_PRICES'][$keyPrice];?>" data-name="<?=$arPrice['NAME'];?>"><?=$arPrice['NAME'];?></li>
													<?endforeach?>
												</ul>
											<?endif;?>
										</div>
									<?endif;?>
								<?endif;?>
								<?if($bOrderViewBasket && $arItem['PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
									<div class="buy_block clearfix">
										<div class="buttons">
											<span class="btn btn-default to_cart animate-load btn-transparent" data-quantity="1"><span><?=GetMessage('BUTTON_TO_CART')?></span></span>
											<a href="<?=$basketURL?>" class="btn btn-default in_cart btn-transparent"><span><span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/inbasket.svg');?><?=GetMessage('BUTTON_IN_CART')?></span></span></a>
										</div>
									</div>
								<?endif;?>
								<?if($arItem['PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES' && !$bOrderViewBasket):?>
									<div class="order<?=($bOrderViewBasket ? ' basketTrue' : '')?>">
										<?if($arItem['PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES' && !$bOrderViewBasket):?>
											<span class="btn btn-default btn-xs animate-load btn-transparent" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_order_product");?>" data-name="order_product" data-autoload-product="<?=$arItem['NAME']?><?=($defaultPrice ? ': '.$defaultPrice : '');?>"><span><?=(strlen($arParams['S_ORDER_PRODUCT']) ? $arParams['S_ORDER_PRODUCT'] : GetMessage('S_ORDER_PRODUCT'))?></span></span>
										<?endif;?>
									</div>
								<?endif;?>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>