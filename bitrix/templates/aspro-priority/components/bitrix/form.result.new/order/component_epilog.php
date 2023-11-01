<?global $USER;?>
<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("form-block".$arParams["WEB_FORM_ID"]);?>
<?if($USER->IsAuthorized()):?>
	<?
	$dbRes = CUser::GetList(($by = "id"), ($order = "asc"), array("ID" => $USER->GetID()), array("FIELDS" => array("ID", "PERSONAL_PHONE")));
	$arUser = $dbRes->Fetch();
	?>
	<script type="text/javascript">
	$(document).ready(function() {
		try{
			$('.form.order input[data-sid=CLIENT_NAME], .form.order input[data-sid=FIO], .form.order input[data-sid=NAME]').val('<?=$USER->GetFullName()?>');
			$('.form.order input[data-sid=PHONE]').val('<?=$arUser['PERSONAL_PHONE']?>');
			$('.form.order input[data-sid=EMAIL]').val('<?=$USER->GetEmail()?>');
			$('.form.order').animateLabels();
		}
		catch(e){
		}
	});
	</script>
<?endif;?>
<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("form-block".$arParams["WEB_FORM_ID"], "");?>