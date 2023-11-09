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
	if(!function_exists("ShowSubItems3")){
		function ShowSubItems3($arItem){
			?>
			<?if($arItem["CHILD"]):?>
				<?$noMoreSubMenuOnThisDepth = false;
				$count = count($arItem["CHILD"]);?>
				<?$lastIndex = count($arItem["CHILD"]) - 1;?>
				
				<?foreach($arItem["CHILD"] as $i => $arSubItem):?>
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
					<?/*if(!$noMoreSubMenuOnThisDepth):?>
						<?ShowSubItems($arSubItem);?>
					<?endif;*/?>
					<?$noMoreSubMenuOnThisDepth |= CPriority::isChildsSelected($arSubItem["CHILD"]);?>
				<?endforeach;?>
				
			<?endif;?>
			<?
		}
	}
	// print_r($arResult);
	?>
	<div class="bottom-menu second">
		<div class="items">
			<?$lastIndex = count($arResult) - 1;?>
			<?foreach($arResult as $i => $arItem):?>
				<?$bLink = strlen($arItem['LINK']);?>
				<div class="item<?=($arItem["SELECTED"] ? " active" : "")?> <?=$arItem["CHILD"] ? 'childs' : ''?> ">
					<div class="title">
						<?if($bLink):?>
							<a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
						<?else:?>
							<span><?=$arItem['TEXT']?></span>
						<?endif;?>
					</div>
                    <?if( $compactFooterMobile == "Y" ):?>
                        <div class="right-menu-icon right-menu-icon_contact"></div>
                    <?endif;?>
				</div>

				<?ShowSubItems3($arItem);?>
			<?endforeach;?>
            <div class="wrap panel-collapse wrap_compact_mobile panel-collapse_contact">
                <div class="item item_contact">
                    <div class="title">
                        <a href="#">ООО «Мавекс Инжиниринг»</a>
                    </div>
                </div>
                <div class="item item_contact">
                    <div class="title">
                        <a href="#">Юридический адрес:</a>
                    </div>
                    <p class="item_contact-desc">355011, Ставропольский край, г. Ставрополь, ул. Пирогова, д.102, помещения 318-326</p>
                </div>
                <div class="item item_contact" style="display: flex; flex-direction: row; align-items: center; gap: 5px;">
                    <div class="title">
                        <a href="#">ИНН:</a>
                    </div>
                    <p class="item_contact-desc" style="margin-top: 0!important;">2635217803</p>
                </div>
                <div class="item item_contact" style="display: flex; flex-direction: row; align-items: center; gap: 5px;">
                    <div class="title">
                        <a href="#">ОГРН:</a>
                    </div>
                    <p class="item_contact-desc" style="margin-top: 0!important;">1162651055401</p>
                </div>
            </div>
		</div>
	</div>
<?endif;?>
