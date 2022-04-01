SPIP-Core v4.1.0 -> v4.1.1 (01 avril 2022)
------------------------------------------

77b30f66d | marcimat     | 2022-04-01 | Coquille dans _SPIP_VERSION_ID Nous sommes en version 4.1 ici, pas 41…
670c07358 | marcimat     | 2022-04-01 | Report chaines de langues (Salvatore)
ee5fe4da3 | marcimat     | 2022-03-31 | Ticket #5109 : bloquer également les fichiers de définition Composer.
e54810948 | marcimat     | 2022-03-31 | Ticket #5109 : Il est recommandé de mettre les fichiers cachés en 404
e2b37d6d2 | marcimat     | 2022-03-31 | Éviter des deprecated (null sur str*) lors de l’utilisation de `#CHEMIN{#ENV{absent}}`


SPIP-plugins-dist v4.1.0 -> v4.1.1 (01 avril 2022)
--------------------------------------------------

archiviste      | ac9d936 | james        | 2022-03-31 | pas de baseline dans le zip généré par git archive. composer.json valide.
archiviste      | 28f3776 | cedric       | 2022-03-09 | un bootstrap qui fonctionne aussi si on lance la suite de tests/ generale sans avoir fait un composer install sur ce p..
archiviste      | ac621ee | james        | 2022-03-08 | fix infomaniak (extension zip récente compilée avec une vieille version de libzip-dev)
archiviste      | ad183da | james        | 2022-03-08 | fix des tests unitaires
archiviste      | a714654 | james        | 2022-03-08 | fix d'erreurs phpstan
archiviste      | db8c431 | james        | 2022-03-08 | fix coding standard
forum           | 0ddb427 | jluc         | 2022-03-27 | Les #NOTES doivent aussi passer par texte_backend et liens_absolus - fixes #4755
medias          | 7704c5d | cy.altern    | 2022-03-28 | Ticket #4857 (suite) : correction du nom de constante `_IMAGE_TAILLE_MINI_AUTOLIEN` (@bricebou)
