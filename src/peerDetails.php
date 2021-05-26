<div class="popUpCont"  style="z-index:10000"<?php //onclick="hideSettings(this)"?>>
<div class="popUp">
<button onclick="hidePopUp(this)">X</button>
<div>
<ul>

<li class="settingsLi"><p class="settingsP" style="width:100%">Node id: <?php echo $id;?> </p></li>
<li class="settingsLi"><p class="settingsP">Node Address: <?php echo getPeerAttribute($c, "netaddr", $i);?> </p></li>
<li class="settingsLi"><p class="settingsP">features: <?php echo getPeerAttribute($c, "features", $i); ?></p></li>
<li class="settingsLi"><p class="settingsP">Canali connessi: <?php echo count($c['peers'][$i]['channels'])?></p></li>

</ul>
<br>
<button  onclick="<?php if(count($c['peers'][$i]['channels']) > 0){
    echo "show(this.parentElement)";}
    else{
        echo "disconnect('"."$id"."','noForce')";
    }
    ?>"id="btDet<?php echo "$id";?>">Disconnect</button>
<div class="toShow" style="display:none">
    There are open channels with this node, are you sure you want to disconnect? All channels will be close
    <div style="display:flex"><button onclick="<?php echo "disconnect('"."$id"."','force')"?>">yes</button><button onclick="show(this.parentElement.parentElement.parentElement)">no</button></div>
</div>
<p style="margin-top: 15px">Open New Channel</p>
<form method="POST">
<div style="display: flex">
<span><label for="newChnId" >Channel Id</label><br><input name="newChnId" id="newChnId" class="bigInput" value="<?php echo $id?>" disabled><br></span>
<span><label for="newChnAmn">Channel Amount</label><br><input name="newChnAmn" id="newChnAmn" value="Amount"><br></span>
</div>
<?php if(isset($chRes)){echo "<p>"; echo $chRes["message"]; echo "</p>";$chRes=NULL; }?>
<button id="tryNewChButton">Fund Channel</button>
</form>	
</div>
</div>
</div>