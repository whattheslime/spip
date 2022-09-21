<?php

declare(strict_types=1);

namespace Spip\Core\Testing;

use Spip\Core\Testing\Exception\TemplateCompilationErrorException;

class Template
{
	private string $fond;

	public function __construct(string $fond)
	{
		$this->fond = $fond;
	}

	public function render(array $contexte = [], string $connect = ''): string
	{
		$infos = $this->rawRender($contexte, $connect);
		if (!empty($infos['erreurs'])) {
			$message = json_encode($infos['erreurs'], \JSON_UNESCAPED_UNICODE|\JSON_PRETTY_PRINT);
			if (!$message) {
				$erreurs = $infos['erreurs'];
				foreach ($erreurs as &$erreur) {
					$erreur = reset($erreur);
				}
				$message = json_encode($erreurs, \JSON_UNESCAPED_UNICODE|\JSON_PRETTY_PRINT);
			}
			throw new TemplateCompilationErrorException($message);
		}
		return $infos['texte'];
	}

	/**
	 * Appele recuperer_fond avec l'option raw pour obtenir un tableau d'informations que l'on complete avec le nom du fond
	 * et les erreurs de compilations generees
	 */
	public function rawRender(array $contexte = [], string $connect = ''): array
	{
		// vider les erreurs
		$this->init_compilation_errors();

		// en mode 'raw' ça ne trim pas le texte, sacrebleu !
		$infos = recuperer_fond($this->fond, $contexte, [
			'raw' => true,
			'trim' => true,
		], $connect);
		$infos['texte'] = trim($infos['texte']);

		// on ajoute des infos supplementaires a celles retournees
		$path = pathinfo($infos['source']);
		$infos['fond'] = $path['dirname'] . '/' . $path['filename']; // = $fond;
		$infos['erreurs'] = $this->get_compilation_errors();

		return $infos;
	}

	/**
	 * Retourne un tableau des erreurs de compilation
	 */
	private function get_compilation_errors(): array
	{
		$debusquer = charger_fonction('debusquer', 'public');
		$erreurs = $debusquer('', '', [
			'erreurs' => 'get',
		]);
		$debusquer('', '', [
			'erreurs' => 'reset',
		]);
		return $erreurs;
	}

	/**
	 * Raz les erreurs de compilation
	 */
	private function init_compilation_errors(): void
	{
		$debusquer = charger_fonction('debusquer', 'public');
		$debusquer('', '', [
			'erreurs' => 'reset',
		]);
	}
}
