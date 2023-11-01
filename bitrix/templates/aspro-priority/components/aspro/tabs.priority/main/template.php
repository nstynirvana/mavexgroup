<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

if (!$arResult['TABS'] || empty($arResult['TABS']))
	return;

$signer = new \Bitrix\Main\Component\ParameterSigner();
$arParams['SET_TITLE'] = 'N';
$arParams["COMPATIBLE_MODE"] = "Y";
$arParamsTmp = $signer->signParameters($this->__component->getName(), array_filter($arParams, fn($key) => strpos($key, '~') !== 0, ARRAY_FILTER_USE_KEY));
?>
<div class="item-views catalog sections1 front blocks">
	<div class="maxwidth-theme">
		<div class="tabs_ajax">
			<div class="tabs_ajax__top-block">
				<h2>
					<?= ($arParams["TITLE"] ?: GetMessage("TITLE")); ?>
				</h2>
				<div class="head-block tabs_ajax__head-block swipeignore tabs horizontal-scrolling"
					<?= (count($arResult["TABS"]) == 1 ? "style='display:none;'" : ""); ?>
					data-plugin-options='{"axis": "x", "scrollInertia": 200, "snapAmount": 70, "scrollButtons": {"enable": true}}'>
					<ul class="scroll-tabs-wrapper">
						<? $i = 0; ?>
						<? foreach ($arResult["TABS"] as $key => $arItem): ?>
							<li class="item-link<?= (!$i++ ? ' active clicked' : ''); ?>">
								<div class="font_xs">
									<span class="dark-color">
										<?= $arItem['TITLE'] ?>
									</span>
								</div>
							</li>
						<? endforeach; ?>
					</ul>
				</div>

				<? if ($arParams['PAGER_SHOW_ALL']): ?>
					<a class="show_all" href="<?= str_replace('#SITE' . '_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL']) ?>">
						<span>
							<?= (strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : GetMessage('S_TO_SHOW_ALL_PRODUCTS')) ?>
						</span>
					</a>
				<? endif; ?>

			</div>

			<span class='request-data' data-value='<?= $arParamsTmp; ?>'></span>
			<div class="body-block">
				<div class="row">
					<div class="col-md-12">
						<? $i = 0; ?>
						<? foreach ($arResult["TABS"] as $key => $arItem): ?>
							<? $signedFilter = $arItem["FILTER"] ? $signer->signParameters($this->__component->getName(), $arItem["FILTER"]) : ''; ?>
							<div class="item-block<?= (!$i ? ' active opacity1' : ''); ?>" data-filter="<?= $signedFilter; ?>">
								<?
								if (!$i++) {
									if ($arItem["FILTER"]) {
										$GLOBALS[$arParams["FILTER_NAME"]] = $arItem["FILTER"];
									}

									include(str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"] . SITE_DIR . "include/mainpage/comp_catalog_ajax.php"));
								}
								?>
							</div>
						<? endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>