<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme, $orderViewBasketHtml;
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
?>
<?if($arResult):?>
	<div class="menu-only">
		<nav class="mega-menu">
			<div class="table-menu">
				<div class="marker-nav"></div>
				<table>
					<tr>
						<?foreach($arResult as $arItem):?>					
							<?$bShowChilds = $arParams["MAX_LEVEL"] > 1;?>
							<td class="menu-item unvisible <?=($arItem["CHILD"] ? "dropdown" : "")?>  <?=($arItem["SELECTED"] ? "active" : "")?>">
								<div class="wrap">
									<a class="dark-color <?=($arItem["CHILD"] && $bShowChilds ? "dropdown-toggle" : "")?>" <?if(!isset($arItem["UF_SHOW_LINK"]) && $arItem["UF_SHOW_LINK"] != 1):?>href="<?=$arItem["LINK"]?>"<?endif;?>>
										<?=$arItem["TEXT"]?>
										<div class="line-wrapper"><span class="line"></span></div>
									</a>
									<?if($arItem["CHILD"] && $bShowChilds):?>
										<span class="tail"></span>
										<ul class="dropdown-menu">
											<?foreach($arItem["CHILD"] as $arSubItem):?>
												<?$bShowChilds = $arParams["MAX_LEVEL"] > 2;?>
												<li class="<?=($arSubItem["CHILD"] && $bShowChilds ? "dropdown-submenu" : "")?> <?=($arSubItem["SELECTED"] ? "active" : "")?>">
													<a <?if(!isset($arSubItem["UF_SHOW_LINK"]) && $arSubItem["UF_SHOW_LINK"] != 1):?>href="<?=$arSubItem["LINK"]?>"<?endif;?> title="<?=$arSubItem["TEXT"]?>"><?=$arSubItem["TEXT"]?><?=($arSubItem["CHILD"] && $bShowChilds ? '<span class="arrow"><i></i></span>' : '')?></a>
													<?if($arSubItem["CHILD"] && $bShowChilds):?>
														<ul class="dropdown-menu">
															<?foreach($arSubItem["CHILD"] as $arSubSubItem):?>
																<?$bShowChilds = $arParams["MAX_LEVEL"] > 3;?>
																<li class="<?=($arSubSubItem["CHILD"] && $bShowChilds ? "dropdown-submenu" : "")?> <?=($arSubSubItem["SELECTED"] ? "active" : "")?>">
																	<a href="<?=$arSubSubItem["LINK"]?>" title="<?=$arSubSubItem["TEXT"]?>"><?=$arSubSubItem["TEXT"]?></a>
																	<?if($arSubSubItem["CHILD"] && $bShowChilds):?>
																		<ul class="dropdown-menu">
																			<?foreach($arSubSubItem["CHILD"] as $arSubSubSubItem):?>
																				<li class="<?=($arSubSubSubItem["SELECTED"] ? "active" : "")?>">
																					<a href="<?=$arSubSubSubItem["LINK"]?>" title="<?=$arSubSubSubItem["TEXT"]?>"><?=$arSubSubSubItem["TEXT"]?></a>
																				</li>
																			<?endforeach;?>
																		</ul>
																		
																	<?endif;?>
																</li>
															<?endforeach;?>
														</ul>
													<?endif;?>
												</li>
											<?endforeach;?>
										</ul>
									<?endif;?>
								</div>
							</td>
						<?endforeach;?>

						<td class="dropdown js-dropdown nosave unvisible">
							<div class="wrap">
								<a class="dropdown-toggle more-items" href="#">
									<span><?=GetMessage("S_MORE_ITEMS");?></span>
								</a>
								<span class="tail"></span>
								<ul class="dropdown-menu"></ul>
							</div>
						</td>

					</tr>
				</table>
			</div>						
		</nav>
	</div>
<?endif;?>