<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$this->setFrameMode(true);
$colmd = 12;
$colsm = 12;
?>
<?if($arResult):?>
	<?
	global $arTheme;
	$compactFooterMobile = $arTheme['COMPACT_FOOTER_MOBILE']['VALUE'];
	if(!function_exists("ShowSubItems2")){
		function ShowSubItems2($arItem, $indexSection){
			?>
			<?if($arItem["CHILD"]):?>
				<?$noMoreSubMenuOnThisDepth = false;
				$count = count($arItem["CHILD"]);?>
				<div id="<?=$indexSection?>" class="wrap panel-collapse wrap_compact_mobile">
					<?foreach($arItem["CHILD"] as $arSubItem):?>
						<?
						if($arSubItem['PARAMS']['TYPE'] == 'PRODUCT'){
							$bProductItem = true;
							continue;
						}
						?>
						<?$bLink = strlen($arSubItem['LINK']);?>
						<div class="item<?=($arSubItem["SELECTED"] ? " active" : "")?>">
							<div class="title">
								<?if($bLink):?>
									<a href="<?=$arSubItem['LINK']?>"><?=$arSubItem['TEXT']?></a>
								<?else:?>
									<span><?=$arSubItem['TEXT']?></span>
								<?endif;?>
							</div>
						</div>
						<?$noMoreSubMenuOnThisDepth |= CPriority::isChildsSelected($arSubItem["CHILD"]);?>
					<?endforeach;?>
				</div>
			<?endif;?>
			<?
		}
	}
	?>

	<?$indexSection = $arParams['ROOT_MENU_TYPE'];?>
	<div class="bottom-menu">
		<div class="items">
			<?foreach($arResult as $i => $arItem):?>
					<?$bLink = strlen($arItem['LINK']);?>
					<div class="item<?=($arItem["SELECTED"] ? " active" : "")?> <?=$arItem["CHILD"] ? 'childs accordion-close" data-parent="#'.$indexSection.'" data-target="#'.$indexSection.'"' : '"'?> >
						<div class="title">
							<?if($bLink):?>
								<a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
							<?else:?>
								<span><?=$arItem['TEXT']?></span>
							<?endif;?>
						</div>

						<?if( $compactFooterMobile == "Y" && $arItem["CHILD"] ):?>
							<div class="right-menu-icon"></div>
						<?endif;?>
					</div>
					<?ShowSubItems2($arItem, $indexSection);?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>