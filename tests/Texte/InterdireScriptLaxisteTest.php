<?php

/**
 * Test unitaire de la fonction interdire_script
 * du fichier inc/texte.php
 *
 */
namespace Spip\Core\Tests\Texte;

use PHPUnit\Framework\TestCase;
class InterdireScriptLaxisteTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        find_in_path("inc/texte.php", '', true);
    }
    public function setUp(): void
    {
        $GLOBALS['filtrer_javascript'] = 1;
    }
    /** @dataProvider providerTexteInterdireScriptLaxiste */
    public function testTexteInterdireScriptLaxiste($expected, ...$args): void
    {
        $actual = interdire_scripts(...$args);
        $this->assertSame($expected, $actual);
        $this->assertEquals($expected, $actual);
    }
    public function providerTexteInterdireScriptLaxiste(): array
    {
        return [["<script type='text/javascript' src='toto.js'></script>", "<script type='text/javascript' src='toto.js'></script>"], ["<script type='text/javascript' src='spip.php?page=toto'></script>", "<script type='text/javascript' src='spip.php?page=toto'></script>"], ["<script type='text/javascript'>var php=5;</script>", "<script type='text/javascript'>var php=5;</script>"], ["<script language='javascript' src='spip.php?page=toto'></script>", "<script language='javascript' src='spip.php?page=toto'></script>"], ["&lt;script language='php'>die();</script>", "<script language='php'>die();</script>"], ["&lt;script language=php>die();</script>", "<script language=php>die();</script>"], ["&lt;script language = php >die();</script>", "<script language = php >die();</script>"]];
    }
}
