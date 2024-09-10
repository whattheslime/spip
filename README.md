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
- [Règles de contribution](https://www.spip.net/fr_article825.html#Regles-de-contribution)
- [Espace de traduction](https://trad.spip.net)

## Politique de sécurité

- [Signaler une faille de sécurité](https://www.spip.net/fr_article6688.html)
- [SECURITY.md](SECURITY.md)

## Installation

### Installation classique

```bash
git clone https://git.spip.net/spip/spip/
composer install --no-dev
```

Mise à jour

```bash
git pull
composer install --no-dev
```

### Installation de développement (prive et plugins-dist via git)

```bash
git clone https://git.spip.net/spip/spip/
composer install
composer local mode-dev
rm -rf plugins-dist prive
composer local install
```

Mise à jour

```bash
git pull
rm composer.local.*
composer local mode-dev
composer local install
```

## Tests pour SPIP

Suite de tests basée sur PHPUnit

### Commandes spécifiques

Lancer tous les tests

```bash
vendor/bin/phpunit
```

Voir le détail de tous les tests lancés (y compris leurs noms)

```bash
vendor/bin/phpunit --display-deprecations --display-errors --display-notices --display-warnings
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
vendor/bin/phpunit --colors ecrire/tests/Sql/
vendor/bin/phpunit --colors --filter=testCouper
```
