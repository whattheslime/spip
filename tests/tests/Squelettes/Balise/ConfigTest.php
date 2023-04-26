<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;

class ConfigTest extends SquelettesTestCase
{
	public function testConfigNomAbsent(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, '[(#CONFIG{pasla}|non)ok]');
	}

	public function testConfigNomAbsentAvecDefaut(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, '[(#CONFIG{pasla,defaut}|=={defaut}|oui)ok]');
	}

	public function testConfigChaine(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, '[(#CONFIG{chaine}|=={une chaine}|oui)ok]');
		$this->assertOkTemplate($templating, '[(#CONFIG{chaine,defaut}|=={une chaine}|oui)ok]');
	}

	public function testConfigValeurZero(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, '[(#CONFIG{zero}|=={0}|oui)ok]');
		$this->assertOkTemplate($templating, '[(#CONFIG{zero,defaut}|=={0}|oui)ok]');
	}

	public function testConfigChaineZero(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, "[(#CONFIG{zeroc}|=={'0'}|oui)ok]");
		$this->assertOkTemplate($templating, "[(#CONFIG{zeroc,defaut}|=={'0'}|oui)ok]");
	}

	public function testArrayAssoc(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, "[(#CONFIG{assoc,'',''}|=={#ARRAY{one,element 1,two,element 2}}|oui)ok]");
		$this->assertOkTemplate($templating, "[(#CONFIG{assoc,defaut,''}|=={#ARRAY{one,element 1,two,element 2}}|oui)ok]");
	}

	public function testArraySerialize(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate(
			$templating,
			'[(#CONFIG{serie}|=={a:2:{s:3:"one";s:9:"element 1";s:3:"two";s:9:"element 2";}}oui)ok]'
		);
		$this->assertOkTemplate(
			$templating,
			'[(#CONFIG{serie,defaut}|=={a:2:{s:3:"one";s:9:"element 1";s:3:"two";s:9:"element 2";}}oui)ok]'
		);
	}

	public function testMetaConfigNomAbsent(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, '[(#CONFIG{/meta/pasla}|non)ok]');
	}

	public function testMetaConfigNomAbsentAvecDefaut(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, '[(#CONFIG{/meta/pasla,defaut}|=={defaut}|oui)ok]');
	}

	public function testMetaConfigChaine(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, '[(#CONFIG{/meta/chaine}|=={une chaine}|oui)ok]');
		$this->assertOkTemplate($templating, '[(#CONFIG{/meta/chaine,defaut}|=={une chaine}|oui)ok]');
	}

	public function testMetaConfigValeurZero(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, '[(#CONFIG{/meta/zero}|=={0}|oui)ok]');
		$this->assertOkTemplate($templating, '[(#CONFIG{/meta/zero,defaut}|=={0}|oui)ok]');
	}

	public function testMetaConfigChaineZero(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, "[(#CONFIG{/meta/zeroc}|=={'0'}|oui)ok]");
		$this->assertOkTemplate($templating, "[(#CONFIG{/meta/zeroc,defaut}|=={'0'}|oui)ok]");
	}

	public function testMetaArrayAssoc(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate($templating, "[(#CONFIG{/meta/assoc,'',''}|=={#ARRAY{one,element 1,two,element 2}}|oui)ok]");
		$this->assertOkTemplate(
			$templating,
			"[(#CONFIG{/meta/assoc,defaut,''}|=={#ARRAY{one,element 1,two,element 2}}|oui)ok]"
		);
	}

	public function testMetaArraySerialize(): void
	{
		$templating = $this->getTemplating();
		$this->assertOkTemplate(
			$templating,
			'[(#CONFIG{/meta/serie}|=={a:2:{s:3:"one";s:9:"element 1";s:3:"two";s:9:"element 2";}}oui)ok]'
		);
		$this->assertOkTemplate(
			$templating,
			'[(#CONFIG{/meta/serie,defaut}|=={a:2:{s:3:"one";s:9:"element 1";s:3:"two";s:9:"element 2";}}oui)ok]'
		);
	}

	public function testAutreTableConfigNomAbsent(): void
	{
		$templating = $this->getTemplatingOtherTable();
		$this->assertOkTemplate($templating, '[(#CONFIG{/toto/tpasla}|non)ok]');
	}

	public function testAutreTableConfigNomAbsentAvecDefaut(): void
	{
		$templating = $this->getTemplatingOtherTable();
		$this->assertOkTemplate($templating, '[(#CONFIG{/toto/tpasla,defaut}|=={defaut}|oui)ok]');
	}

	public function testAutreTableConfigChaine(): void
	{
		$templating = $this->getTemplatingOtherTable();
		$this->assertOkTemplate($templating, '[(#CONFIG{/toto/tchaine}|=={une chaine}|oui)ok]');
		$this->assertOkTemplate($templating, '[(#CONFIG{/toto/tchaine,defaut}|=={une chaine}|oui)ok]');
	}

	public function testAutreTableConfigValeurZero(): void
	{
		$templating = $this->getTemplatingOtherTable();
		$this->assertOkTemplate($templating, '[(#CONFIG{/toto/tzero}|=={0}|oui)ok]');
		$this->assertOkTemplate($templating, '[(#CONFIG{/toto/tzero,defaut}|=={0}|oui)ok]');
	}

	public function testAutreTableConfigChaineZero(): void
	{
		$templating = $this->getTemplatingOtherTable();
		$this->assertOkTemplate($templating, "[(#CONFIG{/toto/tzeroc}|=={'0'}|oui)ok]");
		$this->assertOkTemplate($templating, "[(#CONFIG{/toto/tzeroc,defaut}|=={'0'}|oui)ok]");
	}

	public function testAutreTableArrayAssoc(): void
	{
		$templating = $this->getTemplatingOtherTable();
		$this->assertOkTemplate($templating, "[(#CONFIG{/toto/tassoc,'',''}|=={#ARRAY{one,element 1,two,element 2}}|oui)ok]");
		$this->assertOkTemplate(
			$templating,
			"[(#CONFIG{/toto/tassoc,defaut,''}|=={#ARRAY{one,element 1,two,element 2}}|oui)ok]"
		);
	}

	public function testAutreTableArraySerialize(): void
	{
		$templating = $this->getTemplatingOtherTable();
		$this->assertOkTemplate(
			$templating,
			'[(#CONFIG{/toto/tserie}|=={a:2:{s:3:"one";s:9:"element 1";s:3:"two";s:9:"element 2";}}oui)ok]'
		);
		$this->assertOkTemplate(
			$templating,
			'[(#CONFIG{/toto/tserie,defaut}|=={a:2:{s:3:"one";s:9:"element 1";s:3:"two";s:9:"element 2";}}oui)ok]'
		);
	}

	private function getFakeMetaData(): array
	{
		$assoc = [
			'one' => 'element 1',
			'two' => 'element 2',
		];
		return [
			'zero' => 0,
			'zeroc' => '0',
			'chaine' => 'une chaine',
			'assoc' => $assoc,
			'serie' => serialize($assoc),
		];
	}

	private function getFakeMetaDataT(): array
	{
		$assoc = [
			'one' => 'element 1',
			'two' => 'element 2',
		];
		return [
			'tzero' => 0,
			'tzeroc' => '0',
			'tchaine' => 'une chaine',
			'tassoc' => $assoc,
			'tserie' => serialize($assoc),
		];
	}

	private function getTemplating(): Templating
	{
		$fake = var_export($this->getFakeMetaData(), true);
		return Templating::fromString([
			'fonctions' => "
				function test_meta(\$raz = 0) {
					static \$meta = [];
					if (!\$meta) {
						\$meta = \$GLOBALS['meta'];
					}
					\$GLOBALS['meta'] = {$fake};
					if (\$raz) {
						\$GLOBALS['meta'] = \$meta;
					}
				}
			",
			'avant_code' => '[(#VAL|test_meta)]',
			'apres_code' => '[(#VAL{1}|test_meta)]',
		]);
	}

	private function getTemplatingOtherTable(): Templating
	{
		$fake = var_export($this->getFakeMetaDataT(), true);
		return Templating::fromString([
			'fonctions' => "
				function test_meta_toto(\$raz = 0) {
					\$GLOBALS['toto'] = {$fake};
					if (\$raz) {
						unset(\$GLOBALS['toto']);
					}
				}
			",
			'avant_code' => '[(#VAL|test_meta_toto)]',
			'apres_code' => '[(#VAL{1}|test_meta_toto)]',
		]);
	}
}
