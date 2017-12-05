<?php
// Couleur du texte des champs si erreur saisie utilisateur
$color_font_warn="#FF0000";
// Couleur de fond des champs si erreur saisie utilisateur
$color_form_warn="#FFCC66";
// Ne rien modifier ci-dessous si vous n’êtes pas certain de ce que vous faites !
if(isset($_POST['submit'])){
	$erreur="";
	// Nettoyage des entrées
	while(list($var,$val)=each($_POST)){
	if(!is_array($val)){
		$$var=strip_tags($val);
	}else{
		while(list($arvar,$arval)=each($val)){
				$$var[$arvar]=strip_tags($arval);
			}
		}
	}
	// Formatage des entrées
	$f_2=strip_tags(trim($f_2));
	// Verification des champs
	if(strlen($f_1)<2){
		$erreur.="<li><span class='txterror'>Le champ &laquo; Nom Prénom &raquo; est vide ou incomplet.</span>";
		$errf_1=1;
	}
	if(strlen($f_2)<2){
		$erreur.="<li><span class='txterror'>Le champ &laquo; Email &raquo; est vide ou incomplet.</span>";
		$errf_2=1;
	}else{
		if(!ereg('^[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+'.
		'@'.
		'[-!#$%&\'*+\/0-9=?A-Z^_`a-z{|}~]+\.'.
		'[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+$',
		$f_2)){
			$erreur.="<li><span class='txterror'>La syntaxe de votre adresse e-mail n'est pas correcte.</span>";
			$errf_2=1;
		}
	}
	if($erreur==""){
		// Création du message
		$titre="Message de votre site";
		$tete="From:contact.html\n";
		$corps.="Nom Prénom : ".$f_1."\n";
		$corps.="Email : ".$f_2."\n";
		if(mail("bunelsebastien95@gmail.com", $titre, stripslashes($corps), $tete)){
			$ok_mail="true";
		}else{
			$erreur.="<li><span class='txterror'>Une erreur est survenue lors de l'envoi du message, veuillez refaire une tentative.</span>";
		}
	}
}
?>