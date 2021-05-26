<?php
$title="login";
$description="Login Page";
function login($pass){
	$trueHash = "d74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1";
	$hash =  hash('sha256',$pass,false);
	if ($hash  === $trueHash){
		$_SESSION['login']=1;
		header("Location index.php");
        }
}
if(isset($_POST['loginPassword'])){
    login($_POST['loginPassword']);
    $_POST = array();
    
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
    <link rel="stylesheet" type="text/css" href="../style/test.css">
    <script src="../js/ajaxCalls.js" defer></script>
    <script src="../js/functions.js" defer></script>
    <script src="../js/optionsManager.js" defer></script>
</head>
<body>
<main id="mainLogin">
<div class="linescontainer">
<div class="lines">
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="reverseline" id="rev1"></div>
  <div class="reverseline"  id="rev2"></div>
  <div class="reverseline"  id="rev3"></div>
  <div class="reverseline"  id="rev4"></div>
  <div class="reverseline"  id="rev5"></div>
  <div class="reverseline"  id="rev6"></div>
</div>
</div>
<div style="height: 300px;
width: 500px;
background-color: darkslategray;
margin-top: 15%;
margin-left: 34%;
opacity: 0.6;
position: absolute;
border-radius: 5px;">
</div>
<div id="loginPage"> 
    <h1 style="margin-bottom:20px">login</h1>
     <form method="POST">
     <label for="password">Password </label><br> <input type="password" name="loginPassword" id="loginPassword" required><br>
     <button>login</button>
     </form>
</div>
<p style="color: white;
position: absolute;
font-size: 38px;
margin-left: 18px;
margin-top: 8px;
font-weight: bolder;">Friendl<img src="../img/bolt.png" style="max-width:18px">ght</p>
</main>
</body>
</html>


