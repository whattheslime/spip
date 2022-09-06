<?php

/**
 * Test unitaire de la fonction textebrut
 * du fichier inc/filtres.php
 *
 */
namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;
class TextebrutTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        find_in_path("inc/filtres.php", '', true);
    }
    /** @dataProvider providerFiltresTextebrut */
    public function testFiltresTextebrut($expected, ...$args): void
    {
        $actual = textebrut(...$args);
        $this->assertSame($expected, $actual);
        $this->assertEquals($expected, $actual);
    }
    public function providerFiltresTextebrut(): array
    {
        // TODO
        $essais = [];
        return $essais;
    }
}
