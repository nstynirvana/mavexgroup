<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");?>

<?$APPLICATION->AddHeadString(' <meta name="robots" content="noindex, follow"/>',true)?>
<?CPriority::ShowPageType('page_contacts');?>

<style type="text/css">
	.contacts.front.contacts_page.clearfix.maxwidth-theme{
		max-width: 1920px;
	}
</style>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>