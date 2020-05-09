<?php
$BASE = '../';
include($BASE . 'init.php');
include('reg.php');

unset($_SESSION['admin']);
setcookie('usuari','');

header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
?>