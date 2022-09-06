<?php

/**
 * Test unitaire de la fonction supprimer_numero
 * du fichier inc/filtres.php
 *
 */
namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;
class SupprimerNumeroTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        find_in_path("inc/filtres.php", '', true);
    }
    /** @dataProvider providerFiltresSupprimerNumero */
    public function testFiltresSupprimerNumero($expected, ...$args): void
    {
        $actual = supprimer_numero(...$args);
        $this->assertSame($expected, $actual);
        $this->assertEquals($expected, $actual);
    }
    public function providerFiltresSupprimerNumero(): array
    {
        return [0 => [0 => '1.titre', 1 => '1.titre'], 1 => [0 => 'titre', 1 => '1. titre'], 2 => [0 => '1 .titre', 1 => '1 .titre'], 3 => [0 => '1 . titre', 1 => '1 . titre'], 5 => [0 => 'titre', 1 => '0. titre'], 6 => [0 => 'titre', 1 => ' 0. titre'], 7 => [0 => '-1. titre', 1 => '-1. titre']];
    }
}
