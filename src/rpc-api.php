<?php
error_reporting(E_ALL);
session_start();

function getJson($output){
    $output = json_decode($output,true);
    if(isset($output["error"])){
            return $output["error"];
    }
    else{
     return $output["result"];
    }
}


function command($command){
	$sock = stream_socket_client ( 'unix:///home/light/.lightning/testnet/lightning-rpc', $errno, $errstr, 10);
	
	fwrite($sock, json_encode($command)."\r\n");
	

	while(!feof($sock)) {
			$output = fgets($sock);
			break;
	}
	
	//$output = getJson1(fread($sock, 8192));
	
	
	fclose($sock);
	
	 return getjson($output);
}
	


function getinfo(){
	
$command = [
	"method" => "getinfo",
	"params" => [],
	"id" => 0
];
return command($command);
}

function listpeers(){
    $command = [
        "method" => "listpeers",
        "params" => [],
        "id" => 0
    ];
    return command($command);
}
function listfunds(){
    $command = [
        "method" => "listfunds",
        "params" => [],
        "id" => 0
    ];
    return command($command);
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
    $command = [
        "method" => "connect",
        "params" => [
            "id" => $keyport,
        ],
        "id" => 0
    ];
    return command($command);
}
function disconnect($peerId, $force){
	if(isset($force) && $force == "force"){
        $command = [
            "method" => "disconnect",
            "params" => [
                "id" => $peerId,
                "force" => true,
            ],
            "id" => 0
        ];
	}
	else{
        $command = [
            "method" => "disconnect",
            "params" => [
                "id" => $peerId,
            ],
            "id" => 0
        ];
	}
	return command($command);
}
function simpleFundChannel($peerId, $amount){
    $command = [
        "method" => "fundchannel",
        "params" => [
            "id" => $peerId,
            "amount" => $amount,
        ],
        "id" => 0
    ];
   return command($command);

}
function pay($bolt11){
    $command = [
        "method" => "pay",
        "params" => [
            "bolt11" => $bolt11
        ],
        "id" => 0
    ];
return command($command);
}
function decodepay($bolt11){
    $command = [
        "method" => "decodepay",
        "params" => [
            "bolt11" => $bolt11
        ],
        "id" => 0
    ];
return command($command);
}
function getChannelAttributes($listfunds, $attr, $num){
	return $listfunds["channels"][$num][$attr];
}
function simpleInvoice($msat, $label, $description, $expiry){

    if(isset($expiry)){
    $command = [
    "method" => "invoice",
    "params" => [
        "msatoshi" => $msat,
        "label" => $label,
        "description" => $description,
        "expiry" => $expiry
    ],
    "id" => 0
];$_SESSION["desc"]=$description;
    }
    else{
    $command = [
        "method" => "invoice",
        "params" => [
            "msatoshi" => $msat,
            "label" => $label,
            "description" => $description,
        ],
        "id" => 0
    ];
    $_SESSION["desc"]=$description;
    }
return command($command);
}

function close($peer_id, $addr, $timeout){
    if(isset($addr)){
    $command = [
        "method" => "close",
        "params" => [
            "id" => $peer_id,
            "unilateraltimeout" => $timeout,
            "destination" => $addr,
        ],
        "id" => 0
    ];
    }
    else{
        $command = [
            "method" => "close",
        "params" => [
            "id" => $peer_id,
            "unilateraltimeout" => $timeout,
        ],
        "id" => 0
    ];
    }
    return command($command);
}
function listpays(){
    $command = [
        "method" => "listpays",
    "params" => [],
    "id" => 0
    ];

return command($command);
}
function listInvoices(){
    $command = [
        "method" => "listinvoices",
    "params" => [],
    "id" => 0
     ];

return command($command);
}
function delInvoice($label, $status){
    $command = [
        "method" => "delinvoice",
    "params" => [
        "label" => $label,
        "status" => $status,
    ],
    "id" => 0
    ];
    return command($command);
}
function delPay($pay_hash, $status){
    $command = [
        "method" => "delpay",
    "params" => [
        "payment_hash" => $pay_hash,
        "status" => $status,
    ],
    "id" => 0
    ];
    return command($command);
}
function setAutoCleanInvoice($seconds, $expired_by){
	if(!isset($seconds)){
		$seconds = 0;
		if(!isset($expired_by)){
            $command = [
                "method" => "autocleaninvoice",
            "params" => [
                "cycle_seconds" => $seconds,
            ],
            "id" => 0
            ];
		}
		else{
            $command = [
                "method" => "autocleaninvoice",
            "params" => [
                "cycle_seconds" => $seconds,
                "expired_by" => $expired_by,
            ],
            "id" => 0
            ];
		}
	}
	else{
	   if(!isset($expired_by)){
        $command = [
            "method" => "autocleaninvoice",
        "params" => [
            "cycle_seconds" => $seconds,
        ],
        "id" => 0
        ];
	   }
	   else{
        $command = [
            "method" => "autocleaninvoice",
        "params" => [
            "cycle_seconds" => $seconds,
            "expired_by" => $expired_by,
        ],
        "id" => 0
        ];
	   }
	}
    return command($command);
}
function newAddr($type){
	if(!isset($type)){
        $command = [
            "method" => "newaddr",
        "params" => [],
        "id" => 0
        ];
        
	}
	else{
        $command = [
            "method" => "newaddr",
        "params" => [
            "addresstype" => $type,
        ],
        "id" => 0
        ];
	}
	return readO();
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