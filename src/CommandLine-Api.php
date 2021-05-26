<?php
error_reporting(E_ALL);
function restartD(){
	exec("pkill lightningd",$o);
}
function readO(){
	exec("cat output 2>&1", $o);
	return $o;
}
function erase(){
	exec("rm ./output",$o);
	return;
}
function getJson($file){
        $o = file_get_contents("$file");
	return json_decode($o,true);
}
function trimmer($string){
  return str_replace(',','',str_replace('"','',substr($string, strpos($string, ":") + 1)));

}

function startd(){
        exec("lightningd", $o);
	
}

function getinfo(){
	exec("lightning-cli getinfo > output ", $o);
	$o = readO();
	return getJson("output");
	
}

function listpeers(){
	exec("lightning-cli listpeers > output ", $o);
	$o = file_get_contents("output");
	return json_decode($o, true);
}

function listfunds(){
        exec("lightning-cli listfunds > output", $o);
	return getJson("output");
}

function getCurrentAddr($funds){
        return $funds['outputs'][0]['address'];
}
function getPeerAttribute($plist, $attr, $numPeer){
	if($attr == "netaddr"){
		return getPeerNetAddr($plist, $numPeer);
	}
	else {
	return $plist['peers'][$numPeer][$attr];
	}
	}
function getPeerNetAddr($plist, $numPeer){
	 return $plist['peers'][$numPeer]["netaddr"][0];
}

function connect($keyport){
        exec("lightning-cli connect ".escapeshellarg($keyport)." > output", $o);
	return  getJson("output");
}

function disconnect($peerId, $force){
	if(isset($force) && $force == "force"){
	exec("lightning-cli disconnect ".escapeshellarg($peerId)." force > output", $o);
	}
	else{
		exec("lightning-cli disconnect ".escapeshellarg($peerId)." > output", $o);	
	}
	return getJson("output");
}

function simpleFundChannel($channelId, $amount){
	exec("lightning-cli fundchannel $channelId $amount > output", $o);
        return  getJson("output");
}
function fundChannel($peerId, $amount, $feerate, $announce, $minconf, $uxtos, $push_msat, $close_to ){
	$peerId=escapeshellarg($peerId);
	$amount=escapeshellarg($amount);
	$feerate=escapeshellarg($feerate);
	$announce=escapeshellarg($announce);
	$minconf=escapeshellarg($minconf);
	$uxtos=escapeshellarg($uxtos);
	$push_msat=escapeshellarg($push_msat);
	$close_to=escapeshellarg($close_to);
	exec("lightning-cli fundchannel $peerId $amount $feerate $announce $minconf $uxtos $push_msat $close_to > output",$o);
	return getJson("output");
}
function pay($bolt11){
        exec("lightning-cli pay $bolt11 > output", $o);
	return getJson("output");
}

function decodepay($bolt11){
	exec("lightning-cli decodepay $bolt11 > output", $o);
	return getJson("output");
}

function getChannelAttributes($listfunds, $attr, $num){
	return $listfunds["channels"][$num][$attr];
}
function simpleInvoice($msat, $label, $description, $expiry){
	$msat = escapeshellarg($msat);
	$label = escapeshellarg($label);
	$description= escapeshellarg($description);
	if(isset($expiry)){
	$expiry= escapeshellarg($expiry);
	exec("lightning-cli invoice $msat $label $description $expiry  > output", $o);
	return getJson("output");
	}
	else{
	 exec("lightning-cli invoice $msat $label $description > output",$o);
	 return getJson("output");
	}
}

function listpays(){
	exec("lightning-cli listpays > output", $o);
	return getJson("output");
}
function listInvoices(){
	exec("lightning-cli listinvoices > output", $o);
	return getJson("output");
}
function delInvoice($label, $status){
	$label = escapeshellarg($label);
	$status = escapeShellarg($status);
	exec("lightning-cli delinvoice $label $status > output", $o);
	return getJson("output");
}
function delPay($pay_hash, $status){
	$pay_hash=escapeshellarg($pay_hash);
	$status=escapeshellarg($status);
	exec("lightning-cli delpay $pay_hash $status > output",$o);
	return getJson("output");
}
function setAutoCleanInvoice($seconds, $expired_by){
	if(!isset($seconds)){
		$seconds = 0;
		if(!isset($expired_by)){
			exec("lightning-cli autocleaninvoice > output", $o);
	        return readO();
		}
		else{
			$expired_by = escapeshellarg($expired_by);
			exec("lightning-cli autocleaninvoice 0 $expired_by > output", $o);
	        return readO();
		}
	}
	else{
       $seconds=escapeshellarg($seconds);
	   if(!isset($expired_by)){
		exec("lightning-cli autocleaninvoice $seconds > output", $o);
		return readO();
	   }
	   else{
		   $expired_by=escapeshellarg($expired_by);
		exec("lightning-cli autocleaninvoice $seconds $expired_by > output", $o);
		return readO();
	   }
	}

}
function newAddr($type){
	if(!isset($type)){
		exec("lightning-cli newaddr  > output", $o);
	}
	else{
	$type=escapeshellarg($type);
	exec("lightning-cli newaddr $type > output", $o);
	}
	return readO();
}
function close($peer_id, $addr, $timeout){
	exec("lightning-cli close ".escapeshellarg($peer_id)." ".escapeshellarg($timeout)." ".escapeshellarg($addr)." > output", $o);
	return getJson("output");
}
function getFunds($listfunds){
    $onChainOutputs = $listfunds["outputs"];
    $onChainAmount = 0;
    for($i = 0; $i <= count($onChainOutputs); $i++){
        $onChainAmount = $onChainAmount+$onChainOutputs[$i]["value"];
    }
    $offChainOutputs = $listfunds["channels"];
    $offChainAmount = 0;
    for($i = 0; $i <= count($offChainOutputs); $i++){
        $offChainAmount = $offChainAmount+$offChainOutputs[$i]["channel_sat"];
    }
    $total = [
        "offChainAmount" => $offChainAmount,
        "onChainAmount" => $onChainAmount,
    ];
    return $total;
}
function restartD(){
    exec("sudo service clightning restart",$o);
    return;
}
?>
