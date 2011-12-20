// Futás
$(document).ready(function() {
	// Hosszok belövése
	var x=$('div#fo_doboz').height();
	$('div#tartalom').css('height',x+100);
	$('div#fo_elvalaszto').css('height',x+79);
	$('div#body_racs').css('height',x+638);
	
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