<?php

namespace Spip\Core\Testing;

class Code
{
	private array $options = [];
	private string $adresse_dernier_fichier_pour_code = '';
	private string $cacheDirectory = '';
	private string $connect = '';

	public function __construct(array $options = [], string $connect = '') {
		include_spip('inc/flock');
		$this->cacheDirectory = sous_repertoire(_DIR_CACHE, 'Tests');
		$this->setOptions($options);
		$this->connect = $connect;
	}

	public function render(string $code, array $contexte = []): string {
		$infos = $this->rawRender($code, $contexte);
		return $infos['texte'];
	}

	/**
	 * Appele recuperer_fond avec l'option raw pour obtenir un tableau d'informations
	 * que l'on complete avec le nom du fond et les erreurs de compilations generees
	 */
	public function rawRender(string $code, array $contexte = []): array {
		// vider les erreurs
		$this->init_compilation_errors();
		$infos = $this->recuperer_code($code, $contexte);

		// on ajoute des infos supplementaires a celles retournees
		$path = pathinfo($infos['source']);
		$infos['fond'] = $path['dirname'] . '/' . $path['filename']; // = $fond;
		$infos['erreurs'] = $this->get_compilation_errors();

		return $infos;
	}

	/**
	 * Récupere le resultat du calcul d'une compilation de code de squelette
	 * $coucou = $this->recuperer_code('[(#AUTORISER{ok}|oui)coucou]');
	 *
	 * Voir la fonction recuperer_fond pour les parametres
	 * @param string $code : code du squelette
	 * @param array $contexte : contexte de calcul du squelette
	 * @param array $opt : options ?
	 * @param string $connect : nom de la connexion a la bdd
	 *
	 * @return string/array : page compilee et calculee
	 */
	private function recuperer_code(string $code, array $contexte = []) {

		$options = $this->options;
		$options['raw'] = true;

		if (isset($options['avant_code'])) {
			$code = $options['avant_code'] . $code;
		}
		if (isset($options['apres_code'])) {
			$code .= $options['apres_code'];
		}

		$fond = $this->cacheDirectory . md5($code . serialize($options));
		$this->ecrire_fichier($fond . '.html', $code);

		if (!empty($options['fonctions'])) {
			// un fichier unique pour ces fonctions
			$func = $this->cacheDirectory . "func_" . md5($options['fonctions']) . ".php";
			$this->ecrire_fichier($func, $this->php($options['fonctions']));
			// une inclusion unique de ces fichiers
			$this->ecrire_fichier($fond . '_fonctions.php', $this->php("include_once('$func');"));
		}

		$fond = str_replace('../', '', $fond); // pas de ../ si dans ecrire !
		return recuperer_fond($fond, $contexte, $options, $this->connect);
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
	 * Retourne un tableau des erreurs de compilation
	 */
	private function get_compilation_errors(): array {
		$debusquer = charger_fonction('debusquer', 'public');
		$erreurs = $debusquer('', '', ['erreurs' => 'get']);
		$debusquer('', '', ['erreurs' => 'reset']);
		return $erreurs;
	}

	/**
	 * Raz les erreurs de compilation
	 */
	private function init_compilation_errors(): void {
		$debusquer = charger_fonction('debusquer', 'public');
		$debusquer('', '', array('erreurs' => 'reset'));
	}

	/**
	 * Retourne "<?php $code ?>"
	 * @param string $code	Code php
	 * @return string	Code php complet
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
