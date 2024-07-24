<?php
session_start();

require 'db.php';


//$protocol = $_SERVER['HTTPS'] == '' ? 'http://' : 'https://';
//$folder = $protocol . $_SERVER['HTTP_HOST'];
$parts = explode('/', $_SERVER['SCRIPT_NAME']);
$protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';
$web_root = $protocol.$_SERVER['HTTP_HOST']."/" . $parts[1] .'/';
$web_path = $parts[1] .'/';

?>
