<?php
error_reporting(E_ALL);
require "./settings.php";
error_reporting(E_ALL);

if(isset($_POST['bolt11'])){
	$payRes = pay($_POST['bolt11']);
	$_POST=array();
}
if(isset($_POST['msat'])){
	$invRes = simpleInvoice($_POST["msat"],$_POST["label"],$_POST["description"], NULL);

	$_POST=array();
}
if(isset($_POST['newChnId'])){
	$chRes = simpleFundChannel($_POST['newChnId'], $_POST['newChnAmn']);
	echo "eskere";
	$_POST=array();
}

$b = getinfo();

//$b = getinfo();
$c = listpeers();
$d = listfunds();
$pays = listpays();
$invoices = listInvoices();
//$f = connect("02eb73328faf6e5148006958b0de9b208ee26204974e18e7b54f5472f6a5d74a80@18.198.64.228:9735");
//echo var_dump($a);
//echo var_dump($b);
//echo var_dump($c);
//echo var_dump($d);
//echo var_dump($f);
//echo var_dump($invoices);

?>

<main>
<?php if(isset($ajaxRes)){
echo var_dump($ajaxRes);

}?>

<div id="nodeCont" class="principalContainer" onclick="shadows(this)">
<p class="title">Node Informations</p>
<p>Node id:  <?php echo $b['id']?></p>
<div style="display: flex;margin-top: 31px;">
<div>
<p style="margin-top: 54px">Available onchain funds: <?php echo getFunds($d)["onChainAmount"];?> satoshis</p>
<p  style="margin-top: 15px">Total offchain funds: <?php echo getFunds($d)["offChainAmount"];?> satoshis</p>
<p  style="margin-top: 15px">Total funds: <?php echo getFunds($d)["offChainAmount"]+getFunds($d)["onChainAmount"];?> satoshis</p>
</div>
<div id="doughnutChart" class="chart"></div>
<script>
$(function(){
  $("#doughnutChart").drawDoughnutChart([
	{title: "On-chain satoshis", value : <?php echo getFunds($d)["onChainAmount"];?>, color: "#"+randomColor()},
	<?php  for($i=0;$i < count($d['channels']); $i++) :?>
    { title: "Channel <?php echo $i ?> satoshis",  value : <?php echo $d["channels"][$i]["channel_sat"]?> ,  color: "#"+randomColor()},
	<?php endfor;?>
  ]);
});

	</script>
</div>
<br>
<p style="margin-top: -256px;">Connected peers: </p><div style="height:300px; overflow:auto"><?php for($i=0;$i <  count($c['peers']); $i++){echo '<div >'; 
	echo "<p>"; $id=getPeerAttribute($c, "id", $i); echo $id; echo "</p>";
	echo '<button onclick="showPopUp(this.parentNode)">Show Details</button>';
	 include "./peerDetails.php";
   echo "</div>"; 
}?></div>
<br>
<p>Actual wallet address: <?php echo getCurrentAddr($d); ?></p>
<br>
<div>
<label for="newConn">Connect to new Node</label><br><input name="newConn" id="newConn" value="Node Address" class="bigInput"><br>
<p></p>
<button id="tryConnButton" onclick="newConnection(this)">Connect To New Node</button>
</div>
</div>


<div id="channelCont" class="principalContainer" style="z-index: 3;" onclick="shadows(this)">
<p class="title">Channels manager</p>
<div>
<p>Open New Channel</p>
<form method="POST">
<div style="display: flex">
<span><label for="newChnId" >Channel Id</label><br><input name="newChnId" id="newChnId" class="bigInput" value="channel id"><br></span>
<span><label for="newChnAmn">Channel Amount</label><br><input name="newChnAmn" id="newChnAmn" value="Amount"><br></span>
</div>
<?php if(isset($chRes)){echo "<p>"; echo $chRes["message"]; echo "</p>";$chRes=NULL; }?>
<button id="tryNewChButton">Fund Channel</button>
</form>	
<br>
<p>CHANNELS:</p>
<p>Active channels:  <?php echo $b['num_active_channels']?></p>
<p><?php for($i=0;$i <  count($d['channels']); $i++){ 
	echo '<div>';
	echo '<div style="display:flex">';
	echo '<p onclick="showChnDet(this)">'; echo "Channel $i"; echo "</p>"; 
	echo '<div class="channel_state">';
	if($d['channels'][$i]['state']=="CLOSINGD_COMPLETE" || $d['channels'][$i]['state']=="ONCHAIN"){
		echo '<p  style="background-color: black">waiting</p>';
	}
	if( $d['channels'][$i]['state']=="CLOSED"){
		echo '<p  style="background-color: black">waiting</p>';
	}
	if($d['channels'][$i]['state']=="CHANNELD_NORMAL"){
		echo '<p  style="background-color: green">active</p>';
	}
	if($d['channels'][$i]['state']=="OPENINGD"){
		echo '<p  style="background-color: orange">pening</p>';
	}
	if($d['channels'][$i]['state']=="CHANNELD_SHUTTING_DOWN"){
		echo '<p  style="background-color: grey">closing</p>';
	}
	if($d['channels'][$i]['state']=="AWAITING_UNILATERAL"){
		echo '<p  style="background-color: grey;">closing</p>';
	}
	if($d['channels'][$i]['state']=="CHANNELD_AWAITING_LOCKIN"){
		echo '<p  style="background-color: yellow; color: black">funding</p>';
	}
	echo "</div>";
	echo '<button onclick="hideChnDet(this)" style="display:none" class="chnDetBtn">X</button>';
	echo '</div>';
	echo '<div class="toShow" style="display: none">';
	echo '<p class="detP">State: '.$d['channels'][$i]['state']."</p>";
	echo '<p class="detP">peer id: '.$d["channels"][$i]["peer_id"]."</p>";
	echo '<p class="detP">Available satoshis: '.$d["channels"][$i]["channel_sat"]."</p>";
	echo '<p class="detP">Total channel satoshis: '.$d["channels"][$i]["channel_total_sat"]."</p>";
	echo '<a href="https://www.blockchain.com/'.$blckchnType.'/tx'.'/'.$d["channels"][$i]["funding_txid"].'" target="_blank" rel="noopener noreferrer">Funding transaction: '.$d["channels"][$i]["funding_txid"].'</a>';
	if($d['channels'][$i]['state']=="CHANNELD_NORMAL"){
	echo '<button onclick="showPopUp(this.parentNode)" style="z-index: 100">Close Channel</button>';
	include './closingChannel.php';
	}
	echo '</div>';
	echo '</div>';
	echo '<br>';
}?></p>
</div>
</div>



<div id="payCont" class="principalContainer" onclick="shadows(this)">
<p class="title">Pay</p>
<form method="POST">
<input name="bolt11" id="bolt11" value="bolt11" class="bigInput"><br>
<?php if(isset($payRes)){echo "<p>"; echo $payRes["message"]; echo "</p>";$payRes=NULL; }?>
<button> Pay</button>
</form>
<div>
<br>
<p>Generate Invoice</p>
<form method="POST">
<div class="flexInput">
<input name="msat" id="msat" value="mSat" class=""><br>
<input name="label" id="label" value="label" class=""><br>
<input name="description" id="description" value="description" class=""><br>
</div>
<?php if(isset($invRes)){echo "<p>"; echo $invRes["message"]; echo "</p>"; $invRes=NULL; }?>
<button> Generate</button>
</form>
</div>
</div>


<div id="outcomes" class="principalContainer" onclick="shadows(this)">
<p class="title">Outcomes Transactions</p>
<div>
<ul class="detailsList">
<?php for($i=count($pays["pays"])-1;$i >= 0; $i--){
 echo '<li onclick="showInvDet(this,'."'".$pays['pays'][$i]['bolt11']."');".'">';
 echo '<div>';
 echo '<p style="float:left">';
 echo $pays['pays'][$i]['status'];
 echo "</p>";
 echo '<p class="noStyleP">';
 echo decodepay($pays['pays'][$i]['bolt11'])['description'];
 echo "</p>";
 echo '<p  style="float:right" class="rightPos">';
 echo $pays['pays'][$i]['amount_msat'];
 echo "</p>";
 echo '</div>';
 echo '<div class="toShow" style="display:none">';
 echo '<img src="none">';
 echo '<div class="unstyledDiv">';
 echo '<p class="unstyledP" >Payment hash:'.$pays['pays'][$i]['payment_hash']." </p><br>";
 
 echo '<p class="unstyledP" >Destination Node:'.$pays['pays'][$i]['destination']." </p><br>";

 echo '<p class="unstyledP" onmouseover="getDate(this,'.$pays["pays"][$i]["created_at"].")".'">';
 echo '</div>';
 echo "</div>";
 echo '<div>';
 echo '<button onclick="deletePay('."'".$pays['pays'][$i]["payment_hash"]."','".$pays['pays'][$i]['status']."'".')">Delete payment</button>';
 echo '</div>';
 echo "</li>";
}?>
</ul>
</div>
</div>
<div id="incomes" class="principalContainer" onclick="shadows(this)">
<p class="title">Incomes Transactions</p>
<div>
<ul class="detailsList">
<?php for($i=count($invoices["invoices"])-1;$i >=0; $i--){
 echo '<li onclick="showInvDet(this,'."'".$invoices['invoices'][$i]['bolt11']."');".'">';
 echo '<div style="display:flex">';
 echo '<p style="float:left">';
 echo $invoices['invoices'][$i]['status'];
 echo "</p>";
 echo '<p class="noStyleP">';
 echo $invoices['invoices'][$i]['label'];
 echo "</p>";
 echo '<p style="float:right" class="rightPos">';
 echo $invoices['invoices'][$i]['amount_msat'];
 echo "</p>";
 echo "</div>";
 echo '<div class="toShow" style="display:none">';
 echo '<img src="none">';
 echo '<div class="unstyledDiv">';
 echo '<p class="unstyledP" >Payment hash:'.$invoices['invoices'][$i]['payment_hash']." </p>";
 echo '<input type="text" style="display:none" value="'.$invoices['invoices'][$i]['bolt11'].'">';
 echo '<button onclick="copyText(this)" style="margin-top:20px">Copy bolt11</button>';
 echo '</div>';
 echo "</div>";
 echo '<div>';
 echo '<button onclick="deleteInvoice('."'".$invoices['invoices'][$i]['label']."'".','."'".$invoices['invoices'][$i]['status']."'".')">Delete Invoice</button>';
 echo '</div>';

 echo "</li>";
}?>
</ul>
</div>
</div>
</main>

</body>
<div id="left"></div>
<div id="right"></div>
<?php if($apiType=="CommandLine-Api.php"){erase();}?>