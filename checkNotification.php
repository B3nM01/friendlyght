<?php 
session_start();
require "config.php";
require $apiType;
$postdata = file_get_contents("php://input");
$objPostData = json_decode($postdata);
$request = json_decode(json_encode($objPostData, true));
$array1 = json_decode(json_encode($request), true);


if(isset($request)){
    if(filemtime ( "../clightning.log" )>$_SESSION['lstMod']){
        $file = file("../clightning.log");
        for ($i = max(0, count($file)-1); $i < count($file); $i++) {
        echo $file[$i];
        $_SESSION["notify"]=$file[$i];
        }
        $_SESSION["lstMod"]=filemtime("../clightning.log");
    }else{
      echo "no";
    }
  }
?>