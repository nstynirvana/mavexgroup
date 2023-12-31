<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<?if($arResult['SECTIONS']):?>
	<div class="item-views sections type_5_within">
		<div class="items row list_block">
			<?foreach($arResult['SECTIONS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = strlen($arItem['~PICTURE']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 834, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
				}
				?>
				<div class="col-md-12 col-sm-12">
					<div class="item<?=($imageSectionSrc ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<div class="maxwidth-theme">
							<div class="wrap_item">
								<div class="row">
									<?// icon or preview picture?>
									<?if($imageSectionSrc):?>
										<div class="image pull-right col-md-6 col-sm-6">
											<a href="<?=$arItem['SECTION_PAGE_URL']?>">
												<img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
											</a>
										</div>
									<?endif;?>

									<div class="info col-md-<?=($imageSectionSrc ? 6 : 12)?> col-sm-<?=($imageSectionSrc ? 6 : 12)?>">
										<?// section name?>
										<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
											<div class="title">
												<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="dark-color">
													<?=$arItem['NAME']?>
												</a>
											</div>
										<?endif;?>

										<?// section preview text?>
										<?if(strlen($arItem['UF_TOP_SEO']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
											<div class="previewtext">
												<?=$arItem['UF_TOP_SEO']?>
											</div>
										<?elseif(strlen($arItem['DESCRIPTION']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
											<div class="previewtext">
												<?=$arItem['DESCRIPTION']?>
											</div>
										<?endif;?>
										<?// section child?>
										<?if($arItem['CHILD']):?>
											<div class="text childs">
												<ul>
													<?foreach($arItem['CHILD'] as $arSubItem):?>
													<?$detailPageUrl = $arSubItem['DETAIL_PAGE_URL'];?>
														<?if(is_array($detailPageUrl)):?>
															<?$detailPageUrl = $arSubItem['DETAIL_PAGE_URL'][$arItem['ID']];?>
														<?endif;?>
														<li><a class="colored" href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $detailPageUrl );?>"><?=$arSubItem['NAME']?></a></li>
													<?endforeach;?>
												</ul>
											</div>
										<?endif;?>
										<?if($arItem['CHILD']):?>
											<div class="button"><span class="opener font_upper" data-open_text="<?=GetMessage('CLOSE_TEXT');?>" data-close_text="<?=GetMessage('OPEN_TEXT');?>"><?=GetMessage('OPEN_TEXT');?></span></div>
										<?endif;?>
										<a class="arrow_link" href="<?=$arItem['SECTION_PAGE_URL'];?>"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>