<?php
require_once('lanceur_spip.php');

class AllTests_spipTest extends SpipTestSuite {
	function __construct() {
		parent::__construct('Test de la Classe SpipTest');
		$this->addDir(__FILE__);
	}
}

