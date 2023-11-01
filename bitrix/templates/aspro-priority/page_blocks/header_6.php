<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
require_once('header_options.php')
?>

<header class="header-v<?=$headerType?><?=$fixedMenuClass?><?=$basketViewClass?> small-icons" data-change_color="Y">
	<div class="logo_and_menu-row<?=($isIndex ? ' wbanner' : '')?>">
		<div class="header_container clearfix">
			<div class="logo-row">
				<div class="row">
					<div class="menu-row">
					<div class="right-icons pull-right">
						<?if($bOrder):?>
							<div class="pull-right">
								<div class="wrap_icon wrap_basket">
									<?=CPriority::showBasketLink();?>
								</div>
							</div>
						<?endif;?>
						<?if($bCabinet):?>
							<div class="pull-right">
								<div class="wrap_icon wrap_cabinet">
									<?=CPriority::showCabinetLink(true, false, '');?>
								</div>
							</div>
						<?endif;?>
						<div class="pull-right show-fixed">
							<div class="wrap_icon">
								<?=CPriority::ShowSearch('', '');?>
							</div>
						</div>
						<?if($bPhone || $arRegion):?>
							<div class="pull-right">
								<div class="region_phone">
									<?if($arRegion):?>
										<div class="wrap_icon inner-table-block">
											<?CPriority::ShowListRegions();?>
										</div>
									<?endif?>
									<?if($bPhone):?>
										<div class="wrap_icon inner-table-block">
											<div class="phone-block">
												<div><?CPriority::ShowHeaderPhones('mask');?></div>
												<?if(CPriority::GetFrontParametrValue('CALLBACK_BUTTON') == "Y"):?>												
													<div class="callback_wrap">
														<span class="callback-block animate-load twosmallfont colored" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_callback");?>" data-name="callback"><?=GetMessage("S_CALLBACK")?></span>
													</div>
												<?endif;?>
											</div>
										</div>
									<?endif?>
								</div>
							</div>
						<?endif?>
					</div>
						<div class="logo-block pull-left">
							<?CPriority::ShowBurger();?>
							<div class="logo<?=$logoClass?>">
								<?=CPriority::ShowLogo();?>
							</div>
						</div>
						<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
							array(
								"COMPONENT_TEMPLATE" => ".default",
								"PATH" => SITE_DIR."include/header/menu.php",
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_TEMPLATE" => "include_area.php"
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					</div>
				</div>
			</div>
		</div><?// class=logo-row?>
	</div>
	<div class="line-row visible-xs"></div>
</header>