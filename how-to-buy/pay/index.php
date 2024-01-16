<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Способы оплаты");?>
<?//$APPLICATION->AddHeadString(' <meta name="robots" content="noindex, nofollow"/>',true)?>


    <style type="text/css">
        .pay-table td, .pay-table th{
            border: 1px solid #e0e1e0;
            padding: 10px;
        }
    </style>


    <table class="pay-table">
        <thead>
        <tr>
            <th>Физические лица</th>
            <th>Юридические лица</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <ul>
                    <li>
                        Оплата наличными или переводом после выполнения работ
                    </li>
                </ul>
            </td>
            <td>
                <ul>
                    <li>
                        Оплата по безналичному расчету
                    </li>
                    <li>
                        Возможность гибкой системы оплаты
                    </li>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>

    <h2>Этапы оплаты услуг</h2>
    <ol>
        <li>
            После получения заявки наши сотрудники выезжают на объект для осмотра и проведения замеров.
        </li>
        <li>
            Клиенту высылается коммерческое предложение.
        </li>
        <li>
            После согласования выставляется счет для оплаты .
        </li>
        <li>
            При полной оплате заключается договор и осуществляется оказание услуг.
        </li>
    </ol>

    <p>
        Остались вопросы? <a data-event="jqm" data-param-id="1" data-name="callback">Закажите звонок</a> и наш менеджер проконсультирует вас по телефону.
    </p>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>