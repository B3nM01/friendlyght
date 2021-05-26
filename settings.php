<div id="settingsContainer" class="popUpCont"  <?php //onclick="hideSettings(this)"?>>
<div id="settingsId" class="popUp">
<p><button onclick="hideSettings()">X</button>
<ul>
<div>

<li class="settingsLi"><p class="settingsP">Auto clean expired invoices</p>
<?php if($_SESSION["autoClean"]=="yes"):?>
<button class="slideButton" ><p  class="sliderLeft" onclick=" slide(this,'autoClean')"></p></button>
<?php else:?>
<button class="slideButton" ><p  class="sliderRight" onclick=" slide(this,'autoClean')"></p></button>
<?php endif;?>
</div></li>

<li class="settingsLi"><p class="settingsP">Generate a new wallet address</p>
  <button onclick="setOption('addrType','p2sh-segwit')">p2sh-segwit</button>
  <button onclick="setOption('addrType','beck32')">beck-32</button></li>

<li class="settingsLi"><p class="settingsP">Restart lightningd deamon</p>
   <button onclick="restartD()">Restart</button></li>

</ul>
<p><button style="margin-top:15px" onclick="saveOptions()">Save</button></p>
</div>
</div>