<?php
require_once('lanceur_spip.php');

class Test_filtre_introduction extends SpipTest{
	var $func;
	
	// initialisation
	function Test_filtre_introduction() {
		parent::__construct();
		include_spip('inc/filtres');
		include_spip('public/composer');
		$this->func = chercher_filtre('introduction');

	}
	
	function testPresenceFiltre(){
		if (!$this->func) {
			throw new SpipTestException('Il faut le fichu filtre "introduction" !!');
		}
	}
	
	// la description seule ressort avec propre() sans passer par couper()
	// or couper() enleve les balises <p> et consoeur, il faut en tenir compte dans la coupe
	// du texte, meme si le texte est plus petit
	function testDescriptifRetourneSiPresent(){
		if (!$f = $this->func) return;
		$this->assertEqual(
			propre('description petite'),
			$f('description petite','description plus longue',100,''));
	}
	// couper en plus...
	function testTexteNonCoupeSiPetit(){
		if (!$f = $this->func) return;
		$this->assertEqual(
			paragrapher(couper(propre('description plus longue'),100), true),
			$f('','description plus longue',100,''));
	}
	function testTexteCoupe(){
		if (!$f = $this->func) return;
		$this->assertEqual(
			paragrapher(couper(propre('description plus longue'),10), true),
			$f('','description plus longue',10,''));
		$this->assertNotEqual(
			paragrapher(couper(propre('description plus longue'),20), true),
			$f('','description plus longue',10,''));
	}
	function testTexteAvecBaliseIntro(){
		if (!$f = $this->func) return;
		$this->assertEqual(
			paragrapher(couper(propre('plus'),100), true),
			$f('','description <intro>plus</intro> longue',100,''));
	}
}


class Test_balise_introduction extends SpipTest{

	function testCoupeIntroduction(){
		# include_spip('public/composer');
		@define('_INTRODUCTION_SUITE', '&nbsp;(...)');
		$suite = _INTRODUCTION_SUITE;
		$code = "
			[(#REM) une introduction normale doit finir par _INTRODUCTION_SUITE]
			<BOUCLE_a(ARTICLES){chapo=='.{100}'}{texte>''}{descriptif=''}{0,1}>
			[(#INTRODUCTION)]
			</BOUCLE_a>
			NA necessite un article avec du texte, un chapo long (plus de 1000 caracteres) et pas de descriptif
			<//B_a>
		";
		if (!$this->exceptionSiNa($res = $this->recuperer_code($code))) {
			$this->assertPattern("#".preg_quote($suite . '</p>')."$#", $res);
		}
	}
}

?>
