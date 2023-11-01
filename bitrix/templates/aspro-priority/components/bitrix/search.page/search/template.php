<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<div class="search-page item-views">
	<div class="searchinput">
		<form action="" method="get">
			<?if( $arParams["USE_SUGGEST"] === "Y" ){
				if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
				{
					$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
					$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
					$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
				}
				?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:search.suggest.input",
					"",
					array(
						"NAME" => "q",
						"VALUE" => $arResult["REQUEST"]["~QUERY"],
						"INPUT_SIZE" => 40,
						"DROPDOWN_SIZE" => 10,
						"FILTER_MD5" => $arResult["FILTER_MD5"],
					),
					$component, array("HIDE_ICONS" => "Y")
				);?>
			<?}else{?>
				<input class="q" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" placeholder="<?=GetMessage('SEARCH_PLACEHOLDER');?>" />
			<?}?>
		<?if( $arParams["SHOW_WHERE"] ){?>
			&nbsp;<select class="where" name="where">
				<option value=""><?=GetMessage("SEARCH_ALL")?></option>
				<?foreach($arResult["DROPDOWN"] as $key=>$value):?>
					<option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
				<?endforeach?>
			</select>
		<?}?>
			<button class="btn btn-search" type="submit" name="s" value="<?=GetMessage("SEARCH_GO")?>"><i class="svg svg-search mask"></i></button>
			<input type="hidden" name="how" value="<?=$arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
		<?if( $arParams["SHOW_WHEN"] ){?>
			<div style="clear: both;"></div>
			<div id="search_params" class="search-page-params">
				<?$APPLICATION->IncludeComponent(
					'bitrix:main.calendar',
					'',
					array(
						'SHOW_INPUT' => 'Y',
						'INPUT_NAME' => 'from',
						'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
						'INPUT_NAME_FINISH' => 'to',
						'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
						'INPUT_ADDITIONAL_ATTR' => 'size="10"',
					),
					null,
					array('HIDE_ICONS' => 'Y')
				);?>
			</div>
		<?}?>
		</form>
	</div>
	<?if( isset( $arResult["REQUEST"]["ORIGINAL_QUERY"] ) ){?>
		<div class="alert alert-info">
			<?=GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
		</div><?
	}?>
	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<div class="alert alert-danger"><?//ShowError($arResult["ERROR_TEXT"]);?> <?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></div>
		<?=GetMessage("SEARCH_SINTAX")?>
		<h5><?=GetMessage("SEARCH_LOGIC")?></h5>
		<table class="table1">
			<thead>
				<tr>
					<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td>
					<td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
					<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
					<td><?=GetMessage("SEARCH_AND_ALT")?></td>
				</tr>
				<tr>
					<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
					<td><?=GetMessage("SEARCH_OR_ALT")?></td>
				</tr>
				<tr>
					<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
					<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
				</tr>
				<tr>
					<td align="center" valign="top">( )</td>
					<td valign="top">&nbsp;</td>
					<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
				</tr>
			</tbody>
		</table>
	<?elseif(count($arResult["SEARCH"])>0):?>
		<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
		<div class="items">
			<?foreach($arResult["SEARCH"] as $arItem):?>
				<div class="item">
					<div class="title"><a href="<?=$arItem["URL"]?>"><?=$arItem["TITLE_FORMATED"]?></a></div>
					<?if($arItem["CHAIN_PATH"]):?>
						<ul class="path"><?=$arItem["CHAIN_PATH"]?></ul>
					<?endif;?>
					<?if(strlen($arItem["BODY_FORMATED"])):?>
						<div class="text"><?=$arItem["BODY_FORMATED"]?></div>
					<?endif;?>
					<?if (
						$arParams["SHOW_RATING"] == "Y"
						&& strlen($arItem["RATING_TYPE_ID"]) > 0
						&& $arItem["RATING_ENTITY_ID"] > 0
					):?>
						<div class="search-item-rate"><?
							$APPLICATION->IncludeComponent(
								"bitrix:rating.vote", $arParams["RATING_TYPE"],
								Array(
									"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
									"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
									"OWNER_ID" => $arItem["USER_ID"],
									"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
									"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
									"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
									"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
									"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
									"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
									"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
								),
								$component,
								array("HIDE_ICONS" => "Y")
							);?>
						</div>
					<?endif;?>
				</div>
			<?endforeach;?>
		</div>

		<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N" && $arResult["NAV_STRING"]) {?>
			<div class="pagination_nav">
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?}?>

		<div class="sort">
			<?if($arResult["REQUEST"]["HOW"]=="d"):?>
				<a href="<?=$arResult["URL"]?>&amp;how=r<?=$arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?=$arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
			<?else:?>
				<span class="selected"><?=GetMessage("SEARCH_SORTED_BY_RANK")?></span><span class="separator">|</span><a href="<?=$arResult["URL"]?>&amp;how=d<?=$arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?=$arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
			<?endif;?>
		</div>
	<?else:?>
		<div class="alert alert-danger"><?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?></div>
	<?endif;?>
</div>