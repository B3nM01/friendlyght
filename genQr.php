<?php 
session_start();
require "config.php";
require("./phpqrcode/qrlib.php");
$postdata = file_get_contents("php://input");
$objPostData = json_decode($postdata);
$request = json_decode(json_encode($objPostData, true));
$array1 = json_decode(json_encode($request), true);

if(isset($request)){
    QRcode::png($array1["bolt"], "qr".$array1["number"]);
    }
?>



