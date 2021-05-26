<div class="popUpCont"  style="z-index:10000"<?php //onclick="hideSettings(this)"?>>
<div class="popUp">
<button onclick="hidePopUp(this)">X</button>
<div>
<br>
<p class="detP">You are closing Channel number  <?php echo $i?></p>
<br>
<span><label for="withdAddr" >Address destination(default is your actual wallet)<input name="withdAddr"  value="<?php echo getCurrentAddr($d)?>" class="bigInput"><br></span>
<span><label for="timout" >Timeout for unilateral close(default is 0, no unilateral close)<input name="timeout" type="number"  min="1" max="99999999999999999999999" value="0" class="bigInput"><br></span>

<button onclick="closeChn('<?php echo $d['channels'][$i]['peer_id']?>', this)">Close</button>

</div>
</div>
</div>