# Tests pour SPIP

Suite de tests basée sur PHPUnit, avec un wrapper pour les tests historiques écrits en script PHP standalone ou en squelette HTML

## Installation

Placez-vous à la racine du site.

```
git clone https://git.spip.net/spip/tests.git
cd tests
make tests
```

## Commande principale

Lancer tous les tests
```
make tests
```

## Commandes spécifiques

Lancer tous les tests
```
vendor/bin/phpunit --colors tests
```

Voir le détail de tous les tests lancés (y compris leurs noms)
```
vendor/bin/phpunit --colors --debug tests
```

Lister toutes les suites de tests :
```
vendor/bin/phpunit --colors --debug --list-suites
```

Lister tous les tests :
```
vendor/bin/phpunit --colors --debug --list-tests
```

Pour filtrer les tests et n'en executer que certains :
```
vendor/bin/phpunit --colors --debug tests --filter=unit/propre/
vendor/bin/phpunit --colors --debug --filter=testCouper
```

## Ajouter des tests

TODO

## Legacy

Les tests historiques écrits sous forme de PHP ou de squelette HTML sont joués via les 2 composants `LegacyUnitHtmlTest.php` et `LegacyUnitPhpTest.php`

Il est encore possible de lancer dans le navigateur la suite de tests legacy via l'url `monsite.spip/tests/` mais cette méthode est depréciée et ne lancera pas les tests écrits directement pour PHPUnit
