<?global $arTheme, $arRegion;?>
<?
$bMixMode =  $arParams['TYPE_HEAD_BLOCK']=='mix';
?>
<?if($useSections):?>
	<?$arFilter = array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1);
	$arSelect = array('ID', 'SORT', 'IBLOCK_ID', 'NAME', 'SECTION_PAGE_URL');
	$arParentSections = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), $arFilter, false, $arSelect);
	if($arTheme['SHOW_SECTIONS_REGION']['VALUE'] == 'Y' && $arTheme['USE_REGIONALITY']['DEPENDENT_PARAMS']['REGIONALITY_FILTER_ITEM']['VALUE'] == 'Y' && $arRegion){
		$arParentSectionsElements = CCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y', 'GROUP' => 'IBLOCK_SECTION_ID')), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE', 'PROPERTY_LINK_REGION' => $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_LINK_REGION']), false, false, array('ID', 'IBLOCK_SECTION_ID'));
		foreach($arParentSections as $key => $arParentSection){
			if(!$arParentSectionsElements[$arParentSection['ID']]){
				unset($arParentSections[$key]);
			}
		}
	}

	if($arParentSections)
	{
		$bHasSection = (isset($arSection['ID']) && $arSection['ID']);?>
		<div class="menu_item_selected visible-xs"><?=GetMessage('ALL_PROJECTS');?></div>
		<div class="sections head-block top controls clearfix">
			<div class="item-link shadow border <?=($bHasSection ? '' : 'active');?>">
				<div class="title font_upper_md">
					<?if($bHasSection || !$bMixMode):?>
						<a class="btn-inline black" href="<?=$arResult['FOLDER'];?>"><?=GetMessage('ALL_PROJECTS');?></a>
					<?else:?>
						<span class="btn-inline black" data-filter="all"><?=GetMessage('ALL_PROJECTS');?></span>
					<?endif;?>
				</div>
			</div>
			<?$cur_page = $GLOBALS['APPLICATION']->GetCurPage(true);
			$cur_page_no_index = $GLOBALS['APPLICATION']->GetCurPage(false);?>

			<?foreach($arParentSections as $arParentItem):?>
				<?$bSelected = ($bHasSection && CMenu::IsItemSelected($arParentItem['SECTION_PAGE_URL'], $cur_page, $cur_page_no_index));?>
				<div class="item-link shadow border <?=($bSelected ? 'active' : '');?>">
					<div class="title font_upper_md btn-inline black">
						<?if(!$bHasSection && $bMixMode):?>
							<span class="btn-inline black" data-filter=".s-<?=$arParentItem['ID']?>"><?=$arParentItem['NAME'];?></span>
						<?else:?>
							<?if($bSelected):?>
								<span class="btn-inline black"><?=$arParentItem['NAME'];?></span>
							<?else:?>
								<a class="btn-inline black" href="<?=$arParentItem['SECTION_PAGE_URL'];?>"><?=$arParentItem['NAME'];?></a>
							<?endif;?>
						<?endif;?>
					</div>
				</div>
			<?endforeach;?>
		</div>
		<?if($bMixMode):?>
			<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/mixitup.min.js');?>

			<script>
			$(document).ready(function(){
				$('.mixitup-container .menu_item_selected').on('click', function(){
					if(window.matchMedia('(max-width: 767px)').matches){
						$(this).toggleClass('opened');
						$(this).closest('.mixitup-container').find('.sections').slideToggle(200);
					}
				});
				
				$('.mixitup-container .btn-inline').on('click', function(){
					var text = $(this).text();
					
					$(this).closest('.mixitup-container').find('.menu_item_selected').text(text).removeClass('opened');
					if(window.matchMedia('(max-width: 767px)').matches){
						$(this).closest('.mixitup-container').find('.sections').slideUp(200);
					}
				});
			});
			</script>
		<?endif;?>
	<?}?>
<?elseif($useDate):?>
	<?$arYears = CPriority::GetItemsYear($arParams);
	if($arYears)
	{
		if($arParams['USE_FILTER'] != 'N')
		{
			rsort($arYears);
			$bHasYear = (isset($_GET['year']) && (int)$_GET['year']);
			$year = ($bHasYear ? (int)$_GET['year'] : 0);?>
			<div class="head-block top clearfix projects_filter">
				<div class="hidden-xs">
					<div class="item-link font_upper_md <?=($bHasYear ? '' : 'active');?>">
						<?if($bMixMode):?>
							<div class="title btn-inline black" data-filter="all">
						<?else:?>
							<?if($bHasYear):?>
								<a class="title btn-inline black" href="<?=$arResult['FOLDER'];?>">
							<?else:?>
								<div class="title">
							<?endif;?>
						<?endif;?>
									<span class="btn-inline black"><?=GetMessage('ALL_TIME');?></span>

						<?if($bHasYear && !$bMixMode):?>
							</a>
						<?else:?>
							</div>
						<?endif;?>
					</div>
					<?foreach($arYears as $value):
						$bSelected = ($bHasYear && $value == $year);?>
						<div class="item-link font_upper_md <?=($bSelected ? 'active' : '');?>">
							<?if($bMixMode):?>
								<div class="title btn-inline black" data-filter=".d-<?=$value?>">
							<?else:?>
								<?if($bSelected):?>
									<div class="title btn-inline black">
								<?else:?>
									<a class="title btn-inline black" href="<?=$APPLICATION->GetCurPageParam('year='.$value, array('year'));?>">
								<?endif;?>
							<?endif;?>
									<span class="btn-inline black"><?=$value;?></span>
							<?if($bSelected || $bMixMode):?>
								</div>
							<?else:?>
								</a>
							<?endif;?>
						</div>
					<?endforeach;?>
				</div>
				<select class="visible-xs form-control">
					<option value="<?=$arResult['FOLDER']?>"<?=(!$yearGet ? ' selected' : '')?>><?=GetMessage('ALL_TIME');?></option>
					<?foreach($arYears as $value):?>
					<?
					$bSelected = ($bHasYear && $value == $year);
					?>
					<option value="<?=$APPLICATION->GetCurPageParam('year='.$value, array('year'));?>"<?=($bSelected ? ' selected' : '')?>><?=$value?></option>
					<?endforeach?>
				</select>
				<script>
				$(document).ready(function(){
					$('.head-block select').on('change', function(){
						window.location.href = $(this).find('option:selected').val();
					});
				});
				</script>				
			</div>

			<?if($arParams['TYPE_HEAD_BLOCK']=='mix'):?>
				<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/mixitup.min.js');?>

				<script>
				$(document).ready(function(){
					$('.mixitup-container .menu_item_selected').on('click', function(){
						if(window.matchMedia('(max-width: 767px)').matches){
							$(this).toggleClass('opened');
							$(this).closest('.mixitup-container').find('.sections').slideToggle(200);
						}
					});
					
					$('.mixitup-container .btn-inline').on('click', function(){
						var text = $(this).text();
						
						$(this).closest('.mixitup-container').find('.menu_item_selected').text(text).removeClass('opened');
						if(window.matchMedia('(max-width: 767px)').matches){
							$(this).closest('.mixitup-container').find('.sections').slideUp(200);
						}
					});
				});
				</script>
			<?endif;?>
		<?}?>
		<?
		if($bHasYear)
		{
			$GLOBALS[$arParams["FILTER_NAME"]] = array(
				">DATE_ACTIVE_FROM" => ConvertDateTime("31.12.".($year-1), FORMAT_DATETIME),
				"<=DATE_ACTIVE_FROM" => ConvertDateTime("31.12.".$year, FORMAT_DATETIME),
			);
		}?>
	<?}?>
<?endif;?>