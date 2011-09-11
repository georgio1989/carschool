// Menü elemek resetelése
function clear(){
	for(var i=0;i<=2;i++){// i<=MENÜ SZÁM
		$('li#l_'+i).removeClass('akt');
		$('a#a_'+i).removeClass('akt');
		$('a#a_'+i).removeClass('aktual');
		$('li#l_'+i).addClass('sima');
		$('a#a_'+i).addClass('sima');
	}
}
// Menü váltás
function valt(szam){
	clear();
	$('li#l_'+szam).addClass('akt');
	$('a#a_'+szam).addClass('aktual');
}

// Futás
$(document).ready(function() {
	// Hosszok belövése
	var x=$('div#fo_doboz').height();
	$('div#tartalom').css('height',x+100);
	$('div#fo_elvalaszto').css('height',x+79);
	$('div#body_racs').css('height',x+638);
	
	// Akt menüpont=0.ik
	valt(0);
	// Menük ul hover-re -> a is classt kap
	$("li.m").hover(
		function () {
			var mely=$(this).attr('id');
			$('a#a_'+mely[2]).addClass('akt');
		}, 
		function () {
			var mely=$(this).attr('id');
			$('a#a_'+mely[2]).removeClass('akt');
		}
	);
	
	// Kereső szövegének dinamizálása
	$("input.keres_txt").focus(function() {
		$(this).val('');
	});
	$("input.keres_txt").focusout(function() {
		var ertek=$(this).val();
		if(ertek==''){
			$(this).val('Keresés');
		}else{
			$(this).val(ertek);
		}
	});
	
});