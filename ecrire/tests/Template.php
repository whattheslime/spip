<?php

declare(strict_types=1);

namespace Spip\Test;

use Spip\Test\Exception\TemplateCompilationErrorException;

class Template
{
	public function __construct(
		private readonly string $fond
	) {
	}

	public function render(array $contexte = [], string $connect = ''): string {
		$infos = $this->rawRender($contexte, $connect);
		if (!empty($infos['erreurs'])) {
			$message = json_encode($infos['erreurs'], \JSON_UNESCAPED_UNICODE | \JSON_PRETTY_PRINT);
			if (!$message) {
				$erreurs = $infos['erreurs'];
				foreach ($erreurs as &$erreur) {
					$erreur = reset($erreur);
				}
				$message = json_encode($erreurs, \JSON_UNESCAPED_UNICODE | \JSON_PRETTY_PRINT);
			}
			throw new TemplateCompilationErrorException($message);
		}
		return $infos['texte'];
	}

	/**
	 * Appele recuperer_fond avec l'option raw pour obtenir un tableau d'informations que l'on complete avec le nom du fond
	 * et les erreurs de compilations generees
	 */
	public function rawRender(array $contexte = [], string $connect = ''): array {
		// vider les erreurs
		$this->init_compilation_errors();

		// en mode 'raw' ça ne trim pas le texte, sacrebleu !
		$infos = recuperer_fond($this->fond, $contexte, [
			'raw' => true,
			'trim' => true,
		], $connect);
		$infos['texte'] = trim($infos['texte']);

		if (!empty($infos['source'])) {
			// on ajoute des infos supplementaires a celles retournees
			$path = pathinfo($infos['source']);
			$infos['fond'] = $path['dirname'] . '/' . $path['filename']; // = $fond;
			$infos['erreurs'] = $this->get_compilation_errors();
		} else {
			// on a été interrompu par un minipres ?
			throw new \Exception('Calcul de ' . $this->fond . ' interrompue (minipres?)' . "\n\n" . $infos['texte']);
		}

		return $infos;
	}

	/**
	 * Retourne un tableau des erreurs de compilation
	 */
	private function get_compilation_errors(): array {
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
	private function init_compilation_errors(): void {
		$debusquer = charger_fonction('debusquer', 'public');
		$debusquer('', '', [
			'erreurs' => 'reset',
		]);
	}
}
