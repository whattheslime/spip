# SPIP

[SPIP](https://www.spip.net/) (Système de Publication pour Internet) est un logiciel libre permettant de créer des sites internets,
maintenu par sa communauté avec tendresse.

## Pour démarrer

- [Configuration requise](https://www.spip.net/fr_article4351.html)
- [Versions maintenues](https://www.spip.net/fr_article6500.html)
- [Téléchargement](https://www.spip.net/fr_download)
- [Installation](https://www.spip.net/fr_article6431.html)

## Communauté & contributions

- [Charte](https://www.spip.net/fr_article6431.html)
- [Entraide et discussions](https://discuter.spip.net)
- [Forge Git](https://git.spip.net) (tickets, pull requests)
- [Espace de traduction](https://trad.spip.net)

## Politique de sécurité

- [Reporter une faille de sécurité](https://www.spip.net/fr_article6688.html)
- [SECURITY.md](SECURITY.md)

## Tests pour SPIP

Suite de tests basée sur PHPUnit, avec un wrapper pour les tests historiques écrits en script PHP standalone ou en squelette HTML

### Commandes spécifiques

Lancer tous les tests

```bash
vendor/bin/phpunit --colors tests
```

Voir le détail de tous les tests lancés (y compris leurs noms)

```bash
vendor/bin/phpunit --colors --debug tests
```

Lister toutes les suites de tests :

```bash
vendor/bin/phpunit --colors --debug --list-suites
```

Lister tous les tests :

```bash
vendor/bin/phpunit --colors --debug --list-tests
```

Pour filtrer les tests et n'en executer que certains :

```bash
vendor/bin/phpunit --colors --debug tests --filter=unit/propre/
vendor/bin/phpunit --colors --debug --filter=testCouper
```

### Legacy

Les tests historiques écrits sous forme de PHP ou de squelette HTML sont joués via les 2 composants `LegacyUnitHtmlTest.php` et `LegacyUnitPhpTest.php`

Il est encore possible de lancer dans le navigateur la suite de tests legacy via l'url `monsite.spip/tests/` mais cette méthode est depréciée et ne lancera pas les tests écrits directement pour PHPUnit
