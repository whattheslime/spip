<?php

/**
 * Test unitaire de la fonction url_de_
 * du fichier ./inc/utils.php
 *
 */
namespace Spip\Core\Tests\Utils;

use PHPUnit\Framework\TestCase;
class UrlDeTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        find_in_path("./inc/utils.php", '', true);
    }
    /** @dataProvider providerUtilsUrlDe */
    public function testUtilsUrlDe($expected, ...$args): void
    {
        $actual = url_de_(...$args);
        $this->assertSame($expected, $actual);
        $this->assertEquals($expected, $actual);
    }
    public function providerUtilsUrlDe(): array
    {
        return [0 => [0 => 'http://www.example.org/', 1 => 'http', 2 => 'www.example.org', 3 => '', 4 => 0], 1 => [0 => 'http://www.example.org/', 1 => 'http', 2 => 'www.example.org', 3 => '/spip.php', 4 => 0], 2 => [0 => 'http://www.example.org/', 1 => 'http', 2 => 'www.example.org', 3 => '/spip.php?page=demo', 4 => 0], 3 => [0 => 'http://www.example.org/sousrep/', 1 => 'http', 2 => 'www.example.org', 3 => '/sousrep/spip.php?page=demo', 4 => 0], 4 => [0 => 'http://www.example.org/sousrep/url/arbo/', 1 => 'http', 2 => 'www.example.org', 3 => '/sousrep/url/arbo/page.html', 4 => 0], 5 => [0 => 'http://www.example.org/sousrep/url/', 1 => 'http', 2 => 'www.example.org', 3 => '/sousrep/url/arbo/page.html', 4 => 1], 6 => [0 => 'http://www.example.org/sousrep/', 1 => 'http', 2 => 'www.example.org', 3 => '/sousrep/url/arbo/page.html', 4 => 2], 7 => [0 => 'http://www.example.org/', 1 => 'http', 2 => 'www.example.org', 3 => '/sousrep/url/arbo/page.html', 4 => 3], 8 => [0 => 'http://www.example.org/', 1 => 'http', 2 => 'www.example.org', 3 => '/sousrep/url/arbo/page.html', 4 => 4], 9 => [0 => 'http://www.example.org/', 1 => 'http', 2 => 'www.example.org', 3 => 'http://www.example.org/sousrep/url/arbo/page.html', 4 => 3], 10 => [0 => 'http://www.example.org/', 1 => 'http', 2 => 'www.example.org', 3 => '/?param=http://domain.tld/autre/piege/tordu', 4 => 3], 11 => [0 => 'http:///', 1 => 'http', 2 => '', 3 => '', 4 => 0]];
    }
}
