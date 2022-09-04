<?php
/**
 * Test unitaire de la fonction url_to_ascii
 * du fichier ./inc/distant.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/distant.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_distant_url_to_ascii(...$args) {
	return url_to_ascii(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_distant_url_to_ascii(){
		return [
  0 => 
   [
    0 => 'http://www.spip.net/',
    1 => 'http://www.spip.net/',
  ],
  1 => 
   [
    0 => 'http://www.spip.net/fr_article879.html#BOUCLE-ARTICLES-',
    1 => 'http://www.spip.net/fr_article879.html#BOUCLE-ARTICLES-',
  ],
  2 => 
   [
    0 => 'http://user:pass@www.spip.net:80/fr_article879.html#BOUCLE-ARTICLES-',
    1 => 'http://user:pass@www.spip.net:80/fr_article879.html#BOUCLE-ARTICLES-',
  ],
  3 => 
   [
    0 => 'http://www.xn--spap-7pa.net/',
    1 => 'http://www.spaïp.net/',
  ],
  4 => 
   [
    0 => 'http://www.xn--spap-7pa.net/fr_article879.html#BOUCLE-ARTICLES-',
    1 => 'http://www.spaïp.net/fr_article879.html#BOUCLE-ARTICLES-',
  ],
  5 => 
   [
    0 => 'http://user:pass@www.xn--spap-7pa.net:80/fr_article879.html#BOUCLE-ARTICLES-',
    1 => 'http://user:pass@www.spaïp.net:80/fr_article879.html#BOUCLE-ARTICLES-',
  ],
];
	}











?>