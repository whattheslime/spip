<?php
require_once('lanceur_spip.php');
include_spip(_DIR_TESTS . 'vendor/simpletest/simpletest/browser');
include_spip(_DIR_TESTS . 'vendor/simpletest/simpletest/web_tester');

class Test_inclure extends SpipTest{


	function testInclureNormal(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEqualCode('Hello World','<INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}>');
		$this->assertEqualCode('Hello World','<INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}/>');
	}
	function testInclureDouble(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEqualCode('Hello WorldHello World','<INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}>'
				.'<INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}>');
		$this->assertEqualCode('Hello WorldHello World','
				 <INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}>'
				.'<INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}>');
	}
	function testInclureArray(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$array = '#ARRAY{
			0,'.$dir.'/core/inc/inclus_hello_world,
			1,'.$dir.'/core/inc/inclus_hello_world,
			2,'.$dir.'/core/inc/inclus_hello_world}';
		$this->assertEqualCode('Hello WorldHello WorldHello World',"<INCLURE{fond=$array}>");
	}	
	
	
	function testInclureNormalParam(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEqualCode('Kitty','<INCLURE{fond='.$dir.'/core/inc/inclus_param_test}{test=Kitty}>');
		$this->assertEqualCode('Kitty','<INCLURE{fond='.$dir.'/core/inc/inclus_param_test}{test=Kitty}/>');
	}
	
	function testInclureArrayParam(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$array = '#ARRAY{
			0,'.$dir.'/core/inc/inclus_param_test,
			1,'.$dir.'/core/inc/inclus_hello_world,
			2,'.$dir.'/core/inc/inclus_param_test}';
		$this->assertEqualCode('KittyHello WorldKitty',"<INCLURE{fond=$array}{test=Kitty}>");
		$this->assertEqualCode('KittyHello WorldKitty',"<INCLURE{fond=$array}{test=Kitty}/>");
	}
}

class Test_inclure_inline extends SpipTest{
	
	function testInclureInlineNormal(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEqualCode('Hello World','#INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}');
		$this->assertEqualCode('Hello World','[(#INCLURE{fond='.$dir.'/core/inc/inclus_hello_world})]');
	}
	function testInclureDouble(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEqualCode('Hello WorldHello World','#INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}'
				.'#INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}');
		$this->assertEqualCode('Hello WorldHello World','
				 #INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}'
				.'#INCLURE{fond='.$dir.'/core/inc/inclus_hello_world}');
	}
	function testInclureArray(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$array = '#ARRAY{
			0,'.$dir.'/core/inc/inclus_hello_world,
			1,'.$dir.'/core/inc/inclus_hello_world,
			2,'.$dir.'/core/inc/inclus_hello_world}';
		$this->assertEqualCode('Hello WorldHello WorldHello World',"#INCLURE{fond=$array}");
	}	
	
	
	function testInclureNormalParam(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEqualCode('Kitty','[(#INCLURE{fond='.$dir.'/core/inc/inclus_param_test}{test=Kitty})]');
		$this->assertEqualCode('Kitty','[(#INCLURE{fond='.$dir.'/core/inc/inclus_param_test}{test=Kitty})]');
	}
	
	function testInclureArrayParam(){
		$dir = substr(dirname(dirname(__DIR__)), strlen(_SPIP_TEST_CHDIR) + 1);
		$array = '#ARRAY{
			0,'.$dir.'/core/inc/inclus_param_test,
			1,'.$dir.'/core/inc/inclus_hello_world,
			2,'.$dir.'/core/inc/inclus_param_test}';
		$this->assertEqualCode('KittyHello WorldKitty',"[(#INCLURE{fond=$array}{test=Kitty})]");
		$this->assertEqualCode('KittyHello WorldKitty',"[(#INCLURE{fond=$array}{test=Kitty})]");
	}
	
	/**
	 * Un inclure manquant doit creer une erreur de compilation pour SPIP
	 * qui ne doivent pas s'afficher dans le public si visiteur
	 */ 
	function testInclureManquantGenereErreurCompilation(){
		foreach(array(
			'<INCLURE{fond=carabistouille/de/tripoli/absente}/>ok',
			'#CACHE{0}[(#INCLURE{fond=carabistouille/de/montignac/absente}|non)ok]', 
		) as $code) {
			$infos = $this->recuperer_infos_code($code);
			$this->assertTrue($infos['erreurs']);
		}
	}
	
	function testInclureManquantNAffichePasErreursDansPublic(){

		foreach(array(
			'<INCLURE{fond=carabistouille/de/tripoli/absente}/>ok',
			'#CACHE{0}[(#INCLURE{fond=carabistouille/de/montignac/absente}|non)ok]', // doit retourner ' ok'
		) as $code) {
			// non loggue, on ne doit pas voir d'erreur...
			$browser = new SimpleBrowser();
			$browser->ignoreCookies();
			$browser->get($f=$this->urlTestCode($code));
			# $this->dump($f);
			$this->assertEqual($browser->getResponseCode(), 200);
			# var_dump($browser->getContent());
			$this->assertOk( trim($browser->getContent()) );

			// loggue admin, on doit voir une erreur ...
			# todo
		}
	}
}
