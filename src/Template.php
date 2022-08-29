<?php

namespace Spip\Core\Testing;
use Spip\Core\Testing\Template\LoaderInterface;

class Template
{
	private LoaderInterface $loader;
	private string $connect = '';

	public function __construct(LoaderInterface $loader, string $connect = '') {
		$this->loader = $loader;
		$this->connect = $connect;
	}

	public function render(string $name, array $contexte = []): string {
		$infos = $this->rawRender($name, $contexte);
		return $infos['texte'];
	}

	/**
	 * Appele recuperer_fond avec l'option raw pour obtenir un tableau d'informations
	 * que l'on complete avec le nom du fond et les erreurs de compilations generees
	 */
	public function rawRender(string $name, array $contexte = []): array {
		// vider les erreurs
		$this->init_compilation_errors();

		$source = $this->loader->getSourceFile($name);

		$fond = str_replace('../', '', $source); // pas de ../ si dans ecrire !
		$infos = recuperer_fond($fond, $contexte, ['raw' => true], $this->connect);

		// on ajoute des infos supplementaires a celles retournees
		$path = pathinfo($infos['source']);
		$infos['fond'] = $path['dirname'] . '/' . $path['filename']; // = $fond;
		$infos['erreurs'] = $this->get_compilation_errors();

		return $infos;
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
}
