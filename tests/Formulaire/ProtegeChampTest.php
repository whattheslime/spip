<?php

/**
 * Test unitaire de la fonction protege_champ
 * du fichier ./balise/formulaire_.php
 *
 */
namespace Spip\Core\Tests\Formulaire;

use PHPUnit\Framework\TestCase;
class ProtegeChampTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        find_in_path("./balise/formulaire_.php", '', true);
    }
    /** @dataProvider providerFormulaireProtegeChamp */
    public function testFormulaireProtegeChamp($expected, ...$args): void
    {
        $actual = protege_champ(...$args);
        $this->assertSame($expected, $actual);
        $this->assertEquals($expected, $actual);
    }
    public function providerFormulaireProtegeChamp(): array
    {
        return [0 => [0 => 'i:1;', 1 => 'i:1;'], 1 => [0 => 's:4:"toto";', 1 => 's:4:"toto";'], 2 => [0 => 'b:1;', 1 => 'b:1;'], 3 => [0 => 'b:0;', 1 => 'b:0;'], 4 => [0 => 'a:1:{i:0;s:4:"toto";}', 1 => 'a:1:{i:0;s:4:"toto";}'], 5 => [0 => '', 1 => ''], 6 => [0 => '0', 1 => '0'], 7 => [0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net', 1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net'], 8 => [0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;', 1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;'], 9 => [0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039;', 1 => 'Un texte sans entites &<>"\''], 10 => [0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;', 1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'], 11 => [0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;', 1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>'], 12 => [0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes', 1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes'], 13 => [0 => [], 1 => []], 14 => [0 => [0 => '', 1 => '0', 2 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net', 3 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;', 4 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039;', 5 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;', 6 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;', 7 => 'Un texte avec des retour
a la ligne et meme des

paragraphes'], 1 => [0 => '', 1 => '0', 2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net', 3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;', 4 => 'Un texte sans entites &<>"\'', 5 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>', 6 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>', 7 => 'Un texte avec des retour
a la ligne et meme des

paragraphes']], 15 => [0 => [0 => 0, 1 => -1, 2 => 1, 3 => 2, 4 => 3, 5 => 4, 6 => 5, 7 => 6, 8 => 7, 9 => 10, 10 => 20, 11 => 30, 12 => 50, 13 => 100, 14 => 1000, 15 => 10000], 1 => [0 => 0, 1 => -1, 2 => 1, 3 => 2, 4 => 3, 5 => 4, 6 => 5, 7 => 6, 8 => 7, 9 => 10, 10 => 20, 11 => 30, 12 => 50, 13 => 100, 14 => 1000, 15 => 10000]], 16 => [0 => [0 => '1', 1 => ''], 1 => [0 => true, 1 => false]], 17 => [0 => NULL, 1 => NULL]];
    }
}
