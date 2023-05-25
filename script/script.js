	function inscription()
		{
			mywindow=this.open ("files/other/inscription.php", "mywindow","channelmode=0,directories=0, fullscreen=0, height=510 left=10,location=0, menubar=0, resizable=0, scrollbars=1, status=0, titlebar=0, toolbar=0, top=10, width=500,");
		}
	function ident() {
		var form_err = " "
		if ( document.loger.login.value.length < 1) {
			form_err = " - identifiant invalide !";
		}
		if ( document.loger.pass.value.length < 1) {
			form_err += " - Mot de passe vide";
		}
		if ( form_err != " ") {
			alert(form_err);
			return false;
		}
		return true
	}
	function valider() {
		var form = "Erreur : "
		if (( document.ecrire.email.value.length < 1)||( document.ecrire.email.value == "adresse@mail.com")) {
			form += "E-mail invalide ! - ";
		}
		var verim = 0;
		for (i=1; i<document.ecrire.email.value.length -4; i++) {
			if ( document.ecrire.email.value.charAt(i) == "@") {
				verim = 1;
			}
		}
		if ( verim == 0) {
			form = "Erreur : E-mail invalide ! - ";
		}
		if ( document.ecrire.nom.value.length < 1) {
			form += "Il manque le Nom. - ";
		}
		if ( form != "Erreur : ") {
			alert(form);
			return false;
		}
		return true
	}
	function vider(){
		document.ecrire.email.value="";
	}