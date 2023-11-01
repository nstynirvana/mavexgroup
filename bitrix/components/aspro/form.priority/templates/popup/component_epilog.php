<?global $USER;?>
<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("form-block".$arResult["IBLOCK_CODE"]);?>
<?if($USER->IsAuthorized()):?>
	<?
	$dbRes = CUser::GetList(($by = "id"), ($order = "asc"), array("ID" => $USER->GetID()), array("FIELDS" => array("ID", "PERSONAL_PHONE")));
	$arUser = $dbRes->Fetch();
	?>
	<script type="text/javascript">
	$(document).ready(function() {
		try{
			$('.form.popup input[name=CLIENT_NAME], .form.popup input[name=FIO], .form.popup input[name=NAME]').val('<?=$USER->GetFullName()?>');
			$('.form.popup input[name=PHONE]').val('<?=$arUser['PERSONAL_PHONE']?>');
			$('.form.popup input[name=EMAIL]').val('<?=$USER->GetEmail()?>');
			$('.form.popup').animateLabels();
		}
		catch(e){
		}
	});
	</script>
<?endif;?>
<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("form-block".$arResult["IBLOCK_CODE"], "");?>