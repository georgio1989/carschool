<div id="contener">
	<div id="head">
	</div >
	<!-- Menü -->
	<div id="menu">
		<ul>
			<li class="m" id="l_0"><a id="a_0" href="#" class=""  onclick="valt(0)" >Kezdőlap</a></li>
			<li class="m" id="l_1"><a id="a_1" href="#" class="" onclick="valt(1)" >Kapcsolat</a></li>
			<li class="m" id="l_2"><a id="a_2" href="#" class="" onclick="valt(2)" >Információk</a></li>
		</ul>
		<div class="search">
			<form method="post">
				<input type="submit" value="" name="keres_ok" class="keres_btn" />
				<input type="text" value="Keresés" name="keres_mit" class="keres_txt" />
			</form>
		</div>
	</div>
	<!-- /Menü doboz -->
	<!-- Közép doboz -->
	<div id="tartalom">
		<!-- Oldalsáv doboz -->
		<div id="oldal_sav">
			{cetli}
		</div>
		<!-- /Oldalsáv doboz -->
		<!-- Elválasztó vonal -->
		<div id="fo_elvalaszto"><img src="img/vert_sep.png"/></div>
		<!-- /Elválasztó vonal -->
		<!-- Tényleges tartalom -->
		<div id="fo_doboz">
			<p class="cim">{foCim}</p>
			<hr />
			<p>{contents}</p>	
		</div>
		<!-- /Tényleges tartalom -->
	</div>
	<!-- /Közép -->
	{lab}
</div>
<div id="body_eff_tuk_r">
	<div id="body_eff_tuk">
	</div>
</div>