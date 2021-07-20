<?php
require_once('lanceur_spip.php');

class AllTests_dist_boucles extends SpipTestSuite {
	function __construct() {
		parent::__construct('Boucles SPIP');
		$this->addDir(__FILE__);
	}
}


