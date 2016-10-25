<?php
require_once('lanceur_spip.php');

class AllTests_spipTestCore extends SpipTestSuite {
	function __construct() {
		parent::__construct('Test de Spip Core');
		$this->addDir(__FILE__);
	}
}


