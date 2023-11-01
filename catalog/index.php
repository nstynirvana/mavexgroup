<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Продукция");?>

<?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("/include/production.php"),Array(),Array("MODE"=>"html"));?>


<style type="text/css">
    .side_forms{
        margin: 0 0 0!important;
    }
</style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>