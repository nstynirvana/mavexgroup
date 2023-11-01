<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<div class="social-icons">
	<!-- noindex -->
	<ul>
		<?if(!empty($arResult['SOCIAL_FACEBOOK'])):?>
			<li class="facebook">
				<a href="<?=$arResult['SOCIAL_FACEBOOK']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>">
					<i class="svg svg-social-fb"></i>
					<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_VK'])):?>
			<li class="vk">
				<a href="<?=$arResult['SOCIAL_VK']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_VK')?>">
					<i class="svg svg-social-vk"></i>
					<?=GetMessage('TEMPL_SOCIAL_VK')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_TWITTER'])):?>
			<li class="twitter">
				<a href="<?=$arResult['SOCIAL_TWITTER']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_TWITTER')?>">
					<i class="svg svg-social-twitter"></i>
					<?=GetMessage('TEMPL_SOCIAL_TWITTER')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_INSTAGRAM'])):?>
			<li class="instagram">
				<a href="<?=$arResult['SOCIAL_INSTAGRAM']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>">
					<i class="svg svg-social-instagram"></i>
					<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_TELEGRAM'])):?>
			<li class="telegram">
				<a href="<?=$arResult['SOCIAL_TELEGRAM']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_TELEGRAM')?>">
					<i class="svg svg-social-telegram"></i>
					<?=GetMessage('TEMPL_SOCIAL_TELEGRAM')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_YOUTUBE'])):?>
			<li class="ytb">
				<a href="<?=$arResult['SOCIAL_YOUTUBE']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>">
					<i class="svg svg-social-ytb"></i>
					<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_ODNOKLASSNIKI'])):?>
			<li class="odn">
				<a href="<?=$arResult['SOCIAL_ODNOKLASSNIKI']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>">
					<i class="svg svg-social-odn"></i>
					<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_MAIL'])):?>
			<li class="mail">
				<a href="<?=$arResult['SOCIAL_MAIL']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_MAILRU')?>">
					<i class="svg svg-social-mail"></i>
					<?=GetMessage('TEMPL_SOCIAL_MAILRU')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_PINTEREST'])):?>
			<li class="pinterest">
				<a href="<?=$arResult['SOCIAL_PINTEREST']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_PINTEREST')?>">
					<i class="svg svg-social-pinterest"></i>
					<?=GetMessage('TEMPL_SOCIAL_PINTEREST')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_WHATS'])):?>
			<li class="whats">
				<a href="<?=$arResult['SOCIAL_WHATS']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_WHATS')?>">
					<i class="svg svg-social-whats"></i>
					<?=GetMessage('TEMPL_SOCIAL_WHATS')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_VIBER'])):?>
			<li class="viber">
				<a href="<?=$arResult['SOCIAL_VIBER']?>" class="dark-color" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_VIBER')?>">
					<i class="svg svg-social-viber"></i>
					<?=GetMessage('TEMPL_SOCIAL_VIBER')?>
				</a>
			</li>
		<?endif;?>
	</ul>
	<!-- /noindex -->
</div>