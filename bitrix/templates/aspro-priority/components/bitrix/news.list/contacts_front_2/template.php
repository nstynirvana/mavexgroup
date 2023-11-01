<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?$templateData = array(
	'MAP_PLACEMARK' => $arResult['PLACEMARKS'],
	'MAP_ITEMS' => is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0,
);?>
<?if($arResult['ITEMS']):?>
	<div class="contacts front type_2 contacts_scroll clearfix filials" itemscope itemtype="http://schema.org/Organization">
		<div class="row">
			<div class="col-md-6 item">
				<div class="left_block">
					<div class="top_block">
						<?if($arParams['PAGER_SHOW_ALL']):?>
							<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=($arParams['SHOW_ALL_TITLE'] ? $arParams['SHOW_ALL_TITLE'] : GetMessage('SHOW_ALL_CONTACTS_TITLE'));?></span></a>
						<?endif;?>
						<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : GetMessage("TITLE_CONTACTS"));?></h2>
					</div>
					<div class="items border">
						<?foreach($arResult['ITEMS']  as $arItem):?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="item" data-id="<?=$arItem['ID'];?>" data-coordinates="<?=$arItem['DISPLAY_PROPERTIES']['MAP']['VALUE'];?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<div class="filial">
									<?if(isset($arItem['FIELDS']['NAME']) && strlen($arItem['FIELDS']['NAME'])):?>
										<div class="title"><?=$arItem['~NAME'];?></div>
									<?endif;?>
									<?if(isset($arItem['DISPLAY_PROPERTIES']['PHONE']) && $arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']):?>
										<div class="bottom_block">
											<div class="properties">
												<div class="property phone">
													<?if(is_array($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'])):?>
														<?foreach($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'] as $phone):?>
															<div class="value font_xs">
																<a href="tel:+<?=str_replace(array(' ', ',', '-', '(', ')'), '', $phone);?>" class="black" itemprop="telephone"><?=$phone;?></a>
															</div>
														<?endforeach;?>
													<?endif;?>
												</div>
											</div>
										</div>
									<?endif;?>
								</div>
							</div>
						<?endforeach;?>
					</div>
					<div class="detail_desc_items">
						<span class="top-close fa fa-close"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?></span>
						<?foreach($arResult['ITEMS']  as $arItem):?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="item" data-id="<?=$arItem['ID'];?>">
								<div class="top_block">
									<?if($arParams['PAGER_SHOW_ALL']):?>
										<div class="title"><a href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=$arResult['IBLOCK']['NAME'];?></span></a></div>
									<?endif;?>
									<?if(isset($arItem['FIELDS']['NAME']) && strlen($arItem['FIELDS']['NAME'])):?>
										<div class="address">
											<span itemprop="address"><?=$arItem['~NAME'];?></span>
										</div>
									<?endif;?>
								</div>
								<div class="bottom_block">
									<div class="properties">
										<?if(isset($arItem['DISPLAY_PROPERTIES']['METRO']) && strlen($arItem['DISPLAY_PROPERTIES']['METRO']['VALUE'])):?>
											<div class="property metro">
												<div class="title font_upper"><?=$arItem['DISPLAY_PROPERTIES']['METRO']['NAME'];?></div>
												<div class="value"><?=$arItem['DISPLAY_PROPERTIES']['METRO']['~VALUE'];?></div>
											</div>
										<?endif;?>
										<?if(isset($arItem['DISPLAY_PROPERTIES']['SCHEDULE']) && strlen($arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE']['TEXT'])):?>
											<div class="property schedule">
												<div class="title font_upper"><?=$arItem['DISPLAY_PROPERTIES']['SCHEDULE']['NAME'];?></div>
												<div class="value" itemprop="openingHours"><?=$arItem['DISPLAY_PROPERTIES']['SCHEDULE']['~VALUE']['TEXT'];?></div>
											</div>
										<?endif;?>
										<?if(isset($arItem['DISPLAY_PROPERTIES']['EMAIL']) && strlen($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'])):?>
											<div class="property email">
												<div class="title font_upper"><?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['NAME'];?></div>
												<div class="value" itemprop="email"><a class="dark-color" href="mailto:<?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'];?>"><?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'];?></a></div>
											</div>
										<?endif;?>
										<?if(isset($arItem['DISPLAY_PROPERTIES']['PHONE']) && $arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']):?>
											<div class="property phone">
												<div class="title font_upper"><?=$arItem['DISPLAY_PROPERTIES']['PHONE']['NAME'];?></div>
												<?if(is_array($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'])):?>
													<?foreach($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'] as $phone):?>
														<div class="value" >
															<a href="tel:+<?=str_replace(array(' ', ',', '-', '(', ')'), '', $phone);?>" class="black" itemprop="telephone"><?=$phone;?></a>
														</div>
													<?endforeach;?>
												<?endif;?>
											</div>
										<?endif;?>
									</div>
									<div class="button"><span class="btn btn-default btn-transparent btn-sm animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question");?>" data-name="question"><?=GetMessage('SEND_MESSAGE_BUTTON');?></span></div>
								</div>
							</div>
						<?endforeach;?>
					</div>
				</div>
			</div>
			
<?endif;?>