<?php



header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


error_reporting(E_ALL);
session_start();
if(isset($_SESSION['login'])){
	include "header.php";}
else{include "./login.php";};

?>