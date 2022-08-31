<?php
namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class BaliseSessionTest extends SquelettesTestCase
{
	public static function setUpBeforeClass(): void {
		include_spip('inc/session');
	}

	public function testVisiteurSession(): void {
		$id_auteur = session_get('id_auteur');
		$this->assertEqualsCode($id_auteur, '[(#SESSION{id_auteur})]');
	}

	public function testSessionSet(): void {
		session_set('bonbon', null);
		$this->assertEqualsCode('----', '--#HTTP_HEADER{Content-type: text/html}#CACHE{0}[(#SESSION{bonbon})]--');
		$this->assertEqualsCode('----', '--#HTTP_HEADER{Content-type: text/html}#CACHE{0}[(#SESSION_SET{bonbon,caramel})]--');
		$this->assertEqualsCode('--caramel--', '--#HTTP_HEADER{Content-type: text/html}#CACHE{0}[(#SESSION{bonbon})]--');
		$this->assertEqualsCode('----', '--#HTTP_HEADER{Content-type: text/html}#CACHE{0}[(#SESSION_SET{bonbon,miel})]--');
		$this->assertEqualsCode('--miel--', '--#HTTP_HEADER{Content-type: text/html}#CACHE{0}[(#SESSION{bonbon})]--');
		$this->assertEqualsCode('----', '--#HTTP_HEADER{Content-type: text/html}#CACHE{0}[(#SESSION_SET{bonbon,#NULL})]--');
		$this->assertEqualsCode('----', '--#HTTP_HEADER{Content-type: text/html}#CACHE{0}[(#SESSION{bonbon})]--');
	}
}

