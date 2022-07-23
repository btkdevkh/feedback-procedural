<?php

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

define('DB_HOST', 'localhost');
define('DB_NAME', 'phpfeed');
define('DB_USER', 'root');
define('DB_PASS', '123456789');
