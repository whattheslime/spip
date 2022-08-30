<?php

namespace Spip\Core\Testing\Template\Loader;

class StringLoader implements LoaderInterface
{

	private string $adresse_dernier_fichier_pour_code = '';
	private string $cacheDirectory = '';
	private array $options = [];


	public function __construct(array $options = []) {
		include_spip('inc/flock');
		$this->cacheDirectory = sous_repertoire(_DIR_CACHE, 'Tests');
		$this->setOptions($options);
	}

	public function exists(string $name): bool {
		return true;
	}

	public function getCacheKey(string $name): string {
		return md5($name . serialize($this->options));
	}

	/**
	 * Écrit le code du squelette dans un fichier temporaire de cache
	 */
	public function getSourceFile(string $name): string {

		$fond = $this->cacheDirectory . $this->getCacheKey($name);
		$options = $this->options;
		$code = $name;

		if (isset($options['avant_code'])) {
			$code = $options['avant_code'] . $code;
		}
		if (isset($options['apres_code'])) {
			$code .= $options['apres_code'];
		}

		$this->ecrire_fichier($fond . '.html', $code);

		if (!empty($options['fonctions'])) {
			// un fichier unique pour ces fonctions
			$func = $this->cacheDirectory . "func_" . md5($options['fonctions']) . ".php";
			$this->ecrire_fichier($func, $this->php($options['fonctions']));
			// une inclusion unique de ces fichiers
			$this->ecrire_fichier($fond . '_fonctions.php', $this->php("include_once('$func');"));
		}

		return $fond;
	}

	/**
	 * Définit des options de compilation du code,
	 *
	 * Notamment permet de déclarer des filtres (fonctions) pour le code à compiler
	 *
	 * Stocke des options :
	 * - fonctions : pour ajouter un fichier de fonction au squelette cree (on passe le contenu du fichier)
	 * - avant_code : pour inserer du contenu avant le code
	 * - apres_code : pour inserer du contenu apres le code
	 *
	 * @param array $options : param->valeur des options
	 */
	private function setOptions(array $options = []): void {
		$this->options = $options;
	}

	/**
	 * Retourne "<?php $code ?>"
	 * @param string $code	Code php
	 * @return string Code php complet
	 */
	private function php(string $code): string {
		return "<"."?php\n" . $code . "\n?".">";
	}

	/**
	 * Ecrire un fichier à l'endroit indique
	 *
	 * Le réécrit systématiquement.
	 *
	 * @param string $filename	Adresse du fichier a ecrire
	 * @param string $content	Contenu du fichier
	 */
	private function ecrire_fichier(string $filename, string $content): void {
		if (file_exists($filename)) {
			supprimer_fichier($filename);
		}
		ecrire_fichier($filename, $content);
	}
}
