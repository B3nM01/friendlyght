<?php 

session_start();
require "config.php";
require $apiType;
$postdata = file_get_contents("php://input");
$objPostData = json_decode($postdata);
$request = json_decode(json_encode($objPostData, true));
$array1 = json_decode(json_encode($request), true);


if(isset($request)){
$i=connect($array1["addr"]);
if(isset($i["message"])){
    echo $i["message"];
}
else{echo "connected to the peer, please reload the page to see the updated peers list";};
}



?>