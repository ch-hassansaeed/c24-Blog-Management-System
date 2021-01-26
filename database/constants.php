<?php
session_start();

define("HOST","localhost");
define("USER","root");
define("PASS","");
define("DB","c24_blog_db");

define("DOMAIN","http://localhost:86/c24_blog");

$filepath = realpath(dirname(__FILE__));
$DOMAIN_BASE_PATH=str_replace("database","",$filepath);
define("DOMAIN_BASE_PATH",$DOMAIN_BASE_PATH);

define("COMPANY_NAME","C24");

?>
