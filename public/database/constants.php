<?php
session_start();

define("HOST","localhost");
define("USER","root");
define("PASS","");
define("DB","check24_blog");

define("DOMAIN","http://localhost:86/check24_blog/public");

$filepath = realpath(dirname(__FILE__));
$DOMAIN_BASE_PATH=str_replace("database","",$filepath);
define("DOMAIN_BASE_PATH",$DOMAIN_BASE_PATH);

define("COMPANY_NAME","C24");

?>