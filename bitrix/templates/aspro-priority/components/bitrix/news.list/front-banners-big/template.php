<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>

<script>
    $(document).ready({
        $('.item.clone h1').remove();
    });
</script>

<?if($arResult['ITEMS']):?>
	<?
	global $arTheme;
	$bHideOnNarrow = $arTheme['BIGBANNER_HIDEONNARROW']['VALUE'] === 'Y';
	$bannerMobile = $arTheme['BIGBANNER_MOBILE']['VALUE'];
	$slideshowSpeed = abs(intval($arTheme['BIGBANNER_SLIDESSHOWSPEED']['VALUE']));
	$animationSpeed = abs(intval($arTheme['BIGBANNER_ANIMATIONSPEED']['VALUE']));
	$bAnimation = ($slideshowSpeed && strlen($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE']));
	$touch = (count($arResult['ITEMS']) > 1 ? "" : '"touch": false,');
	if($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE'] === 'FADE'){
		$animationType = 'fade';
	}
	else{
		$animationType = 'slide';
		$animationDirection = 'horizontal';
		if($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE'] === 'SLIDE_VERTICAL'){
			$animationDirection = 'vertical';
		}
	}
	?>
	<style>
		@media (max-width: 769px){
			.box.item .tablet_img{
				width: 100%;
				height: 380px;
				z-index: 1;
			}
			.box.item .tablet_img .lazyloaded{
				width: 100%;
				height: 380px;
				background-size: cover;
				background-position: bottom;
			}
			.box.item .maxwidth-theme{
				position: absolute!important;
				top: 0;
			}
			.maxwidth-theme .row .col-md-6.text .inner{
				padding-top: 30px!important;
			}
			.maxwidth-theme .row .col-md-6.text .inner .buttons{
				margin: 0 -3px -3px;
			}

		}
	</style>
	<div class="banners-big front<?=($bHideOnNarrow ? ' hidden_narrow' : '')?> view_<?=$bannerMobile?>">
		<div class="maxwidth-banner">
			<div class="flexslider unstyled <?=($animationDirection == 'vertical' ? 'vertical' : '')?>" data-plugin-options='{"video": true, <?=$touch?> "directionNav": true, "customDirection": ".nav-carousel a", "controlNav": true, <?=($bAnimation && empty($touch) ? '"slideshow": true,' : '"slideshow": false,')?> <?=($animationType ? '"animation": "'.$animationType.'",' : '')?> <?=($animationDirection ? '"direction": "'.$animationDirection.'",' : '')?> <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "animationLoop": true}'>
				<ul class="slides items">
					<?$bShowH1 = false;?>
					<?foreach($arResult['ITEMS'] as $i => $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						$bHasUrl = boolval(strlen($arItem["PROPERTIES"]["LINKIMG"]["VALUE"]));
						$target = $arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"];
						$imageBgSrc = is_array($arItem['DETAIL_PICTURE']) ? $arItem['DETAIL_PICTURE']['SRC'] : '';
						$type = $arItem['PROPERTIES']['BANNERTYPE']['VALUE_XML_ID'];
						$bOnlyImage = $type == 'T1' || !$type;
						$bLinkOnName = strlen($arItem['PROPERTIES']['LINKIMG']['VALUE']);
						$headerColor = (isset($arItem['DISPLAY_PROPERTIES']['HEADER_COLOR']) && strlen($arItem['DISPLAY_PROPERTIES']['HEADER_COLOR']['VALUE_XML_ID']) ? $arItem['DISPLAY_PROPERTIES']['HEADER_COLOR']['VALUE_XML_ID'] : 'dark');
						$bSectionName = (isset($arItem['DISPLAY_PROPERTIES']['SECTION']) && strlen($arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']) ? true : false);
						$bH1 = (isset($arItem['DISPLAY_PROPERTIES']['TITLE_H1']) && $arItem['DISPLAY_PROPERTIES']['TITLE_H1']['VALUE_XML_ID'] == 'Y' ? true : false);
						// video options
						$videoSource = strlen($arItem['PROPERTIES']['VIDEO_SOURCE']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['VIDEO_SOURCE']['VALUE_XML_ID'] : 'LINK';
						$videoSrc = $arItem['PROPERTIES']['VIDEO_SRC']['VALUE'];
						$tabletImgSrc = ($arItem["PROPERTIES"]['TABLET_IMAGE']['VALUE'] ? CFile::GetPath($arItem["PROPERTIES"]['TABLET_IMAGE']['VALUE']) : $background);
						if($videoFileID = $arItem['PROPERTIES']['VIDEO']['VALUE']){
							$videoFileSrc = CFile::GetPath($videoFileID);
						}
						$videoPlayer = $videoPlayerSrc = '';
						if($bShowVideo = $arItem['PROPERTIES']['SHOW_VIDEO']['VALUE_XML_ID'] === 'YES' && ($videoSource == 'LINK' ? strlen($videoSrc) : strlen($videoFileSrc))){
							$colorSubstrates = ($arItem['PROPERTIES']['COLOR_SUBSTRATES']['VALUE_XML_ID'] ? $arItem['PROPERTIES']['COLOR_SUBSTRATES']['VALUE_XML_ID'] : '');
							$buttonVideoText = $arItem['PROPERTIES']['BUTTON_VIDEO_TEXT']['VALUE'];
							$bVideoLoop = $arItem['PROPERTIES']['VIDEO_LOOP']['VALUE_XML_ID'] === 'YES';
							$bVideoDisableSound = $arItem['PROPERTIES']['VIDEO_DISABLE_SOUND']['VALUE_XML_ID'] === 'YES';
							$bVideoAutoStart = $arItem['PROPERTIES']['VIDEO_AUTOSTART']['VALUE_XML_ID'] === 'YES';
							$bVideoCover = $arItem['PROPERTIES']['VIDEO_COVER']['VALUE_XML_ID'] === 'YES';
							$bVideoUnderText = $arItem['PROPERTIES']['VIDEO_UNDER_TEXT']['VALUE_XML_ID'] === 'YES';
							if(strlen($videoSrc) && $videoSource === 'LINK'){
								$videoPlayer = 'YOUTUBE';
								$videoSrc = htmlspecialchars_decode($videoSrc);
								if(strpos($videoSrc, 'iframe') !== false){
									$re = '/<iframe.*src=\"(.*)\".*><\/iframe>/isU';
									preg_match_all($re, $videoSrc, $arMatch);
									$videoSrc = $arMatch[1][0];
								}
								$videoPlayerSrc = $videoSrc;

								switch($videoSrc){
									case(($v = strpos($videoSrc, 'vimeo.com/')) !== false):
										$videoPlayer = 'VIMEO';
										if(strpos($videoSrc, 'player.vimeo.com/') === false){
											$videoPlayerSrc = str_replace('vimeo.com/', 'player.vimeo.com/', $videoPlayerSrc);
										}
										if(strpos($videoSrc, 'vimeo.com/video/') === false){
											$videoPlayerSrc = str_replace('vimeo.com/', 'vimeo.com/video/', $videoPlayerSrc);
										}
										break;
									case(($v = strpos($videoSrc, 'rutube.ru/')) !== false):
										$videoPlayer = 'RUTUBE';
										break;
									case(strpos($videoSrc, 'watch?') !== false && ($v = strpos($videoSrc, 'v=')) !== false):
										$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 2, 11);
										break;
									case(strpos($videoSrc, 'youtu.be/') !== false && $v = strpos($videoSrc, 'youtu.be/')):
										$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 9, 11);
										break;
									case(strpos($videoSrc, 'embed/') !== false && $v = strpos($videoSrc, 'embed/')):
										$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 6, 11);
										break;
								}

								$bVideoPlayerYoutube = $videoPlayer === 'YOUTUBE';
								$bVideoPlayerVimeo = $videoPlayer === 'VIMEO';
								$bVideoPlayerRutube = $videoPlayer === 'RUTUBE';

								if(strlen($videoPlayerSrc)){
									$videoPlayerSrc = trim($videoPlayerSrc.
										($bVideoPlayerYoutube ? '?autoplay=1&enablejsapi=1&controls=0&showinfo=0&rel=0&disablekb=1&iv_load_policy=3' :
										($bVideoPlayerVimeo ? '?autoplay=1&badge=0&byline=0&portrait=0&title=0' :
										($bVideoPlayerRutube ? '?quality=1&autoStart=0&sTitle=false&sAuthor=false&platform=someplatform' : '')))
									);
								}
							}
							else{
								$videoPlayer = 'HTML5';
								$videoPlayerSrc = $videoFileSrc;
							}
						}
						$bImgWithVideo = ($bShowVideo && !$bVideoAutoStart && $arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "image");
						$bTabletImgWithVideo = $bShowVideo && !$bVideoAutoStart;
						?>
						<li class="box<?=($bHasUrl ? ' wurl' : '')?> item<?=($bShowVideo ? ' wvideo' : '');?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>" data-text_color="<?=$headerColor?>" style="background:url('<?=$imageBgSrc?>') center center / cover no-repeat !important;" data-slide_index="<?=$i?>" <?=($bShowVideo ? ' data-video_source="'.$videoSource.'"' : '')?><?=(strlen($videoPlayer) ? ' data-video_player="'.$videoPlayer.'"' : '')?><?=(strlen($videoPlayerSrc) ? ' data-video_src="'.$videoPlayerSrc.'"' : '')?><?=($bVideoAutoStart ? ' data-video_autoplay="1"' : '')?><?=($bVideoDisableSound ? ' data-video_disable_sound="1"' : '')?><?=($bVideoLoop ? ' data-video_loop="1"' : '')?><?=($bVideoCover ? ' data-video_cover="1"' : '')?>>
							<?//echo $tabletImgSrc;?>
							<div class="tablet_img">
								<div style="background-image:url('<?=$tabletImgSrc?>');">
								</div>
							</div>
							<div class="maxwidth-theme<?=($bOnlyImage && $bLinkOnName ? ' fulla' : '')?>">
								<div class="row <?=$arItem['PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID']?> <?=($type != 'T2' ? 'righttext' : '')?> <?=($type === 'T1' ? 'bg-transparent' : '')?>">
									<?$name = ($arItem['DETAIL_TEXT'] ? $arItem['DETAIL_TEXT'] : $arItem['NAME']);?>
									<?ob_start();?>
									<?
										$bShowButton1 = (strlen($arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON1LINK']['VALUE']));
										$bShowButton2 = (strlen($arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON2LINK']['VALUE']));
									?>
									<?if(!$bOnlyImage):?>
										<?if($bSectionName):?>
											<div class="section"><?=$arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']?></div>
										<?endif?>
										<?if($bH1 && !$bShowH1):?>
											<h1><?=$arItem['NAME'];?></h1>
											<?$bShowH1 = false;?>
										<?elseif($bLinkOnName):?>
											<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>" class="title-link">
												<div class="title"><?=htmlspecialchars_decode($arItem['NAME'])?></div>
											</a>
										<?else:?>
											<div class="title"><?=$arItem['NAME']?></div>
										<?endif;?>
										<div class="text-block">
											<?=$arItem['PREVIEW_TEXT']?>
										</div>
										<div class="buttons">
											<?if($bShowVideo && !$bVideoAutoStart && !$bShowButton1 && !$bShowButton2):?>
												<!-- <span class="play btn-video small <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?>" title="<?=$buttonVideoText?>"></span> -->
											<?elseif($bShowButton1 || $bShowButton2):?>
												<?if($bShowVideo):?>
												<span class="btn <?=($bVideoAutoStart ? 'hidden' : '')?> <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?> btn-video" title="<?=$buttonVideoText?>"><?=$buttonVideoText?></span>
												<?endif;?>
												<?if($bShowButton1):?>
													<a href="<?=$arItem['PROPERTIES']['BUTTON1LINK']['VALUE']?>" class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON1CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON1CLASS']['VALUE_XML_ID'] : 'btn-default')?>">
														<?=$arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']?>
													</a>
												<?endif;?>
												<?if($bShowButton2):?>
													<a href="<?=$arItem['PROPERTIES']['BUTTON2LINK']['VALUE']?>" class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON2CLASS']['VALUE_XML_ID'] ) ? $arItem['PROPERTIES']['BUTTON2CLASS']['VALUE_XML_ID'] : 'btn-default white')?>">
														<?=$arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']?>
													</a>
												<?endif;?>
											<?endif;?>
										</div>
									<?endif;?>
									<?$text = ob_get_clean();?>

									<?ob_start();?>
									<?if(is_array($arItem['PREVIEW_PICTURE'])):?>
										<?if($bLinkOnName):?>
											<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>" class="image">
												<img class="plaxy"  src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=($arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
											</a>
										<?else:?>
											<img class="plaxy" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=($arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
										<?endif;?>
									<?endif;?>
									<?$img = ob_get_clean();?>

									<?if(!$bOnlyImage || (is_array($arItem['PREVIEW_PICTURE']) && !$bOnlyImage)):?>
										<?if($bShowVideo && !$bVideoAutoStart && !$bShowButton1 && !$bShowButton2):?>
											<span class="play btn-video small <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?>" title="<?=$buttonVideoText?>"></span>
										<?endif;?>
										<div class="col-md-6 <?=$type == 'T2' ? 'text' : 'img'?>">
											<div class="inner">
												<?=$type == 'T2' ? $text : $img?>
											</div>
										</div>
										<div class="col-md-6 <?=$type == 'T2' ? 'img' : 'text'?>">
											<div class="inner">
												<?=$type == 'T2' ? $img : $text?>
											</div>
										</div>
									<?elseif($bOnlyImage && $bLinkOnName):?>
										<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>"></a>
									<?elseif($bOnlyImage):?>
										<?if($bShowVideo && !$bVideoAutoStart):?>
											<div class="video_block">
												<span class="play btn-video <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?>" title="<?=$buttonVideoText?>"></span>
											</div>
										<?endif;?>
									<?endif;?>
									<div class="loading_video">
									  <hr/><hr/><hr/><hr/>
									</div>

									<?/*if($bannerMobile == 2 || $bannerMobile == 3):?>
										<?if($bannerMobile == 2):?>
											<?ob_start();?>
												<?if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] != "image"):?>
													<?
													$bShowButton1 = (strlen($arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']) && (strlen($arItem['PROPERTIES']['BUTTON1LINK']['VALUE']) || strlen($arItem['PROPERTIES']['FORM_CODE1']['VALUE'])));
													$bShowButton2 = (strlen($arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']) && (strlen($arItem['PROPERTIES']['BUTTON2LINK']['VALUE']) || strlen($arItem['PROPERTIES']['FORM_CODE2']['VALUE'])));
													?>
													<?if($arItem["NAME"]):?>
														<?if($bLinkOnName):?>
															<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>" class="title-link">
																<div class="title"><?=$name?></div>
															</a>
														<?else:?>
															<div class="title"><?=$name?></div>
														<?endif;?>
													<?endif;?>
													<div class="text-block">
														<?=$arItem['PREVIEW_TEXT']?>
													</div>
													<?if($bShowVideo && !$bVideoAutoStart && !$bShowButton1 && !$bShowButton2):?>
														<span class="play btn-video <?=($bVideoAutoStart ? 'loading' : '');?> small <?=$buttonVideoClass;?>" title="<?=$buttonVideoText?>"></span>
													<?elseif($bShowButton1 || $bShowButton2):?>
														<div class="banner_buttons">
															<?if($bShowVideo && !$bVideoAutoStart):?>
																<span class="btn btn-default <?=($bVideoAutoStart ? 'loading' : '');?> btn-video <?=($buttonVideoText ? '' : 'ntext');?> <?=$buttonVideoClass;?>" title="<?=$buttonVideoText?>"><?=$buttonVideoText?></span>
															<?endif;?>
															<?if($bShowButton1):?>
																<a href="<?=$arItem['PROPERTIES']['BUTTON1LINK']['VALUE']?>" <?=($arItem['PROPERTIES']['FORM_CODE1']['VALUE'] ? 'data-event="jqm" data-param-id="'.CAllcorp2::getFormID($arItem['PROPERTIES']['FORM_CODE1']['VALUE']).'" data-name="order_from_banner"' : '');?> class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON1CLASS']['VALUE']) ? $arItem['PROPERTIES']['BUTTON1CLASS']['VALUE'] : 'btn-default btn-transparent-bg')?>">
																	<?=$arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']?>
																</a>
															<?endif;?>
															<?if($bShowButton2):?>
																<a href="<?=$arItem['PROPERTIES']['BUTTON2LINK']['VALUE']?>" <?=($arItem['PROPERTIES']['FORM_CODE2']['VALUE'] ? 'data-event="jqm" data-param-id="'.CAllcorp2::getFormID($arItem['PROPERTIES']['FORM_CODE2']['VALUE']).'" data-name="order_from_banner"' : '');?> class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON2CLASS']['VALUE'] ) ? $arItem['PROPERTIES']['BUTTON2CLASS']['VALUE'] : 'btn-default')?>">
																	<?=$arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']?>
																</a>
															<?endif;?>
														</div>
													<?endif;?>
												<?endif;?>
											<?$tablet_text = trim(ob_get_clean());?>
											<div class="wrap" >
												<?if(strlen($tablet_text)):?>
													<div class="inner">
														<div class="tablet_img" <?=$bannerMobile == 2 ? 'style="background:url('.$imageBgSrc.') center center / cover no-repeat;"' : ''?>><?=$img?></div>
														<div class="tablet_text"><?=$tablet_text?></div>
													</div>
												<?endif;?>
											</div>
										<?elseif($bannerMobile == 3):?>
											<?$tabletImgSrc = ($arItem["PROPERTIES"]['TABLET_IMAGE']['VALUE'] ? CFile::GetPath($arItem["PROPERTIES"]['TABLET_IMAGE']['VALUE']) : $background);?>
												<div class="tablet_img">
													<div style="background-image:url('<?=$tabletImgSrc?>');">
														<?if($bTabletImgWithVideo):?>
															<div class="wrap">
																<div class="video_block">
																	<?if($bShowVideo && !$bVideoAutoStart && ($bShowButton1 || $bShowButton2)):?>
																		<span class="play btn btn-video <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?>" title="<?=$buttonVideoText?>"></span>
																	<?endif;?>
																</div>
															</div>
														<?endif;?>
													</div>
												</div>
										<?endif;?>
									<?endif;*/?>
								</div>
							</div>
							<?if($bHasUrl):?>
								<a class="target" href="<?=$arItem["PROPERTIES"]["LINKIMG"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>></a>
							<?endif;?>
							<?if($bShowVideo):?>
								<div class="overlay<?=($colorSubstrates ? ' '.$colorSubstrates : '');?>"></div>
								
								<? if ($bVideoCover): ?>
									<button type="button" class="video_block__sound-control<?= !$bVideoDisableSound ? ' active' : ''; ?>">
										<svg width="20" height="20">
											<use class="sound-control--on" xlink:href="<?= SITE_TEMPLATE_PATH; ?>/images/svg/sound.svg#on" />
											<use class="sound-control--off" xlink:href="<?= SITE_TEMPLATE_PATH; ?>/images/svg/sound.svg#off" />
										</svg>
									</button>
								<? endif; ?>
							<?endif;?>
						</li>
					<?endforeach;?>
				</ul>
				<div class="nav-carousel">
					<ul class="flex-direction-nav">
						<li class="flex-nav-prev">
							<a href="javascript:void(0)" class="flex-prev"><span>Prev</span></a>
						</li>
						<li class="flex-nav-next">
							<a href="javascript:void(0)" class="flex-next"><span>Next</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?if($bInitYoutubeJSApi):?>
		<script type="text/javascript">
		BX.ready(function(){
			var tag = document.createElement('script');
			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		});
		</script>
	<?endif;?>
<?endif;?>