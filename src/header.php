<?php
error_reporting(E_ALL);
require "config.php";

require $apiType;
require "./phpqrcode/qrlib.php";




$ajaxRes=getJson("output");

if(!isset($_SESSION["lstMod"])){
$_SESSION["lstMod"]=filemtime ("../clightning.log" );
}
if(!isset($_SESSION["autoClean"])){
$_SESSION["autoClean"]="no";
}

if(isset($_SESSION["notify"])){
   
    if(!isset($_SESSION["notifications"])){$_SESSION["notifications"]="<li>".$_SESSION['notify']."</li>"; $_SESSION["numNot"]=1;}
    else{$_SESSION["notifications"]=("<li>".$_SESSION['notify']."</li>".$_SESSION["notifications"]);$_SESSION["numNot"]+=1;}
    $_SESSION["notify"]=NULL;
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no,
    initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="HTML, CSS, JavaScript">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/victormono@latest/dist/index.min.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/torta.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../js/ajaxCalls.js" defer></script>
    <script src="../js/functions.js" defer></script>
    <script src="../js/optionsManager.js" defer></script>
    <script src="../js/torta.js" defer></script>

</head>
<div class="header">
<ul>
<li><h1 style="width: max-content">FRIENDL<img src="../img/bolt.png" style="margin:0px; max-width:20px">GHT</h1></li>
<li style="width: 100%"><p>based on c-lightning <?php echo getinfo()["version"]; if($apiType=="CommandLine-Api.php"){erase();}?></p></li>

<li style="margin-left: 0%; display:flex" id="notification" >
<img id="settingsImg" src="../img/settings.png" onclick="showSettings()">
<div style="width:100px;">
<p id="notNum" onclick="showNotifications(this)"<?php if(!isset($_SESSION["numNot"])){echo 'style="display:none"';}?>><?php echo $_SESSION["numNot"]?></p>
           <ul id="notUl" style="display:none" onclick="hideNotifications(this)">
           <li style="height:0px; display:none"></li>
           <?php if(isset($_SESSION["notifications"])){echo $_SESSION["notifications"];}?>
           </ul>
            <img src="../img/notification.png"></div>
</li>
</ul>
</div>
<?php include "main.php";?>
<body>
