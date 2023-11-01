<?
if (mail("a.sotnikov@dapsite.ru", "заголовок", "текст")) {
    echo 'Отправлено';
}
else {
    echo 'Не отправлено';
}
?>