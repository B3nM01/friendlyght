<?php 

session_start();
require "config.php";
require $apiType;
$postdata = file_get_contents("php://input");
$objPostData = json_decode($postdata);
$request = json_decode(json_encode($objPostData, true));
$array1 = json_decode(json_encode($request), true);


if(isset($request)){
simpleFundChannel($array1["ch_id"],$array1["amnt"]);
}



?>