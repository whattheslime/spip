# SPIP

[SPIP](https://www.spip.net/) (Système de Publication pour Internet) est un logiciel libre permettant de créer des sites internets,
maintenu par sa communauté avec tendresse.

## Pour démarrer

- [Configuration requise](https://www.spip.net/fr_article4351.html)
- [Versions maintenues](https://www.spip.net/fr_article6500.html)
- [Téléchargement](https://www.spip.net/fr_download)
- [Installation](https://www.spip.net/fr_rubrique151.html)

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
vendor/bin/phpunit
```

Voir le détail de tous les tests lancés (y compris leurs noms)

```bash
vendor/bin/phpunit --debug
```

Lister toutes les suites de tests :

```bash
vendor/bin/phpunit --list-suites
```

Lister tous les tests :

```bash
vendor/bin/phpunit --list-tests
```

Pour filtrer les tests et n'en executer que certains :

```bash
vendor/bin/phpunit --colors --debug --filter=unit/propre/
vendor/bin/phpunit --colors --debug --filter=testCouper
```
