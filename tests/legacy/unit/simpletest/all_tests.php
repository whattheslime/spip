<?php
require_once('lanceur_spip.php');

class AllSpipTests extends SpipTestSuite {
	function __construct() {
		parent::__construct('Tous les tests SPIP');
		$this->addDir(__FILE__);
	}
}


