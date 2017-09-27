<?php
// session_start();
//
$dbhost = "localhost"; // Адрес сервера MySQL. На локальном сервере этот параметр всегда будет 'localhost', но на хостинге он соответствует адресу хостера.
$dbname = "EPRtable"; // Имя базы данных
$dbuser = "root"; // Пользователь базы данных
$dbpass = "root"; // Пароль пользователя базы данных
//
// @mysql_connect($dbhost, $dbuser, $dbpass) or die("Ошибка MySQL: " . mysql_error());
// @mysql_select_db($dbname) or die("Ошибка MySQL: " . mysql_error());
    $epr_base = new PDO('mysql:host=localhost;dbname=EPRtable', $dbuser, $dbpass);
?>
