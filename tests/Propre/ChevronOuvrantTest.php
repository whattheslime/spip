<?php

/**
 * Test unitaire de la fonction propre
 * du fichier inc/texte.php
 *
 * cas du chevron ouvrant
 *
 */
namespace Spip\Core\Tests\Propre;

use PHPUnit\Framework\TestCase;
class ChevronOuvrantTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        find_in_path("inc/texte.php", '', true);
    }
    public function setUp(): void
    {
        $GLOBALS['meta']['type_urls'] = "page";
        $type_urls = "page";
        // initialiser les plugins qui changent les intertitre (Z), et les restaurer juste apres
        $mem = [$GLOBALS['debut_intertitre'] ?? null, $GLOBALS['spip_raccourcis_typo'] ?? null];
        propre('rien du tout');
        [$GLOBALS['debut_intertitre'], $GLOBALS['spip_raccourcis_typo']] = $mem;
    }
    /** @dataProvider providerPropreChevronOuvrant */
    public function testPropreChevronOuvrant($expected, ...$args): void
    {
        $actual = propre(...$args);
        $this->assertSame($expected, $actual);
        $this->assertEquals($expected, $actual);
    }
    public function providerPropreChevronOuvrant(): array
    {
        return [0 => [0 => '<p>a&lt;b</p>', 1 => 'a<b'], 1 => [0 => '<p><i>a&lt;b</i></p>', 1 => '{a<b}'], 2 => [0 => '<p><strong>a&lt;b</strong></p>', 1 => '{{a<b}}'], 3 => [0 => '<h2 class="spip">a&lt;b</h2>', 1 => '{{{a<b}}}'], 4 => [0 => '<p><i>0 &lt; a &lt; 1</i> et <i>a > 5</i></p>', 1 => '{0 < a < 1} et {a > 5}'], 5 => [0 => '<p><i>0 &lt; a &lt; 1.0</i> et <i>a > 5</i></p>', 1 => '{0 < a < 1.0} et {a > 5}']];
    }
}
