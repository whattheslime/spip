<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;

class SessionTest extends SquelettesTestCase
{
	public static function setUpBeforeClass(): void
	{
		include_spip('inc/session');
		spip_tests_loger_webmestre();
	}

	public static function tearDownAfterClass(): void
	{
		spip_tests_deloger_webmestre();
	}

	public function testVisiteurSession(): void
	{
		$id_auteur = session_get('id_auteur');
		$this->assertEqualsCode("$id_auteur", '[(#SESSION{id_auteur})]');
	}

	public function testSessionSet(): void
	{
		session_set('bonbon', null);
		$this->assertEqualsCode('1----', '1--#HTTP_HEADER{Content-type: text/html}[(#SESSION{bonbon})]--');
		$this->assertEqualsCode('2----', '2--#HTTP_HEADER{Content-type: text/html}[(#SESSION_SET{bonbon,caramel})]--');
		$this->assertEqualsCode('3--caramel--', '3--#HTTP_HEADER{Content-type: text/html}[(#SESSION{bonbon})]--');
		$this->assertEqualsCode('4----', '4--#HTTP_HEADER{Content-type: text/html}[(#SESSION_SET{bonbon,miel})]--');
		$this->assertEqualsCode('5--miel--', '5--#HTTP_HEADER{Content-type: text/html}[(#SESSION{bonbon})]--');
		$this->assertEqualsCode('6----', '6--#HTTP_HEADER{Content-type: text/html}[(#SESSION_SET{bonbon,#NULL})]--');
		$this->assertEqualsCode('7----', '7--#HTTP_HEADER{Content-type: text/html}[(#SESSION{bonbon})]--');
	}
}
