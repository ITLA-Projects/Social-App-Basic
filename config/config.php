<?php


define('URL',str_replace("\\",'/',"http://".$_SERVER['HTTP_HOST'].substr(getcwd(),strlen($_SERVER['DOCUMENT_ROOT'])))."/");

define('HOST','localhost');
define('DB','social_network');
define('USER','root');
define('PASSWORD','');
define('CHARSET','utf8mb4');
?>