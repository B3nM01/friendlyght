<div id="advChnPopUpCont" class="popUpCont"  <?php //onclick="hideSettings(this)"?>>
<div id="advChnPopUpId" class="popUp">
<p><button onclick="hideSettings()">X</button>
<form method="POST">
<div style="display: flex">
<span><label for="advChnId" >Node Id</label><br><input name="newChnId" id="advChnId" class="bigInput" value="node id"><br></span>
<span><label for="advChnAmn">Channel Amount</label><br><input name="advChnAmn" id="advChnAmn" value="Amount"><br></span>
<span><label for="feeRate">Fee Rate</label><br><input name="feeRate" id="feeRate" value="fee value"><br></span>
<span><label for="announce">Announce</label><br><input name="announce" id="announce" value="announce"><br></span>
<span><label for="minconf">minconf</label><br><input name="minconf" id="minconf" value="minconf"><br></span>
<span><label for="ne">Channel Amount</label><br><input name="newChnAmn" id="newChnAmn" value="Amount"><br></span>
<span><label for="newChnAmn">Channel Amount</label><br><input name="newChnAmn" id="newChnAmn" value="Amount"><br></span>
<span><label for="newChnAmn">Channel Amount</label><br><input name="newChnAmn" id="newChnAmn" value="Amount"><br></span>
<span><label for="newChnAmn">Channel Amount</label><br><input name="newChnAmn" id="newChnAmn" value="Amount"><br></span>
<span><label for="newChnAmn">Channel Amount</label><br><input name="newChnAmn" id="newChnAmn" value="Amount"><br></span>


</div>
<?php if(isset($chRes)){echo "<p>"; echo $chRes["message"]; echo "</p>";$chRes=NULL; }?>
<button id="tryNewChButton">Fund Channel</button>
</form>
<p><button onclick="saveOptions()">Save</button></p>
</div>
</div>