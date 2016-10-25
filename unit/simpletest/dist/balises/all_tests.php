<?php
require_once('lanceur_spip.php');

class AllTests_balises extends SpipTestSuite {
	function __construct() {
		parent::__construct('Balises SPIP');
		$this->addDir(__FILE__);
	}
}


