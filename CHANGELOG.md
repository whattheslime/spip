# Changelog

Changelog de SPIP 4.3

## 4.3.2 - 2024-08-20

### Security

- Mise à jour de l’écran de sécurité en version 1.6.3

### Changed

- #5979 Revert du calcul automatique des chaînes de langue du menu Créer du bandeau de l’espace privé
- !6024 Éviter notice dans `init_http` en cas de "seriously malformed URLs"

### Fixed

- #5983 (retour partiel sur #5667) Générer des contenus éditoriaux aussi compatibles xhtml (sur `br` et `img`)
- !6016 Afficher aussi dans l’espace privé le tableau des requêtes du mode `var_profile=1`
- #5979 Modifier les chaînes de langues utilisées pour les objets déclarés dans le menu Créer (article, rubrique, auteur)

## 4.3.1 - 2024-08-01

### Changed

- #5977 Toutes les balises déséchappent les modèles (introduction de `retablir_echappements_modeles()` appliqué à toutes les balises)
- #5977 `interdire_script` ne s’occupe plus de déséchapper les modèles

### Fixed

- #5976 Modifier `$spip_version_code` pour vider le cache lors de le mises à jour vers 4.3
- #5977 Le filtre `|propre` gère mieux les échappements des modèles
- #5913 Le filtre `|sinon` rétablit correctement les échappements des modèles
- #5961 Correction complémentaire du bandeau de l’espace privé pour les navigateurs sans `:has`
- #5861 Ne pas désactiver le clic sur les `.btn_desactive`

## 4.3.0 - 2024-07-26

### Security

- Mise à jour de l’écran de sécurité en version 1.6.2

### Added

- #5938 Permettre à `objet_info()` de retourner directement l’information `table_objet_sql` (le nom de la table sql)

### Changed

- Chaînes de langues de ecrire/lang/ dans le nouveau format (sans globale).

### Fixed

- spip-security/securite#4855 Ne pas du dupliquer l’attribut `class` sur les balises `<code>`
- #5327 Permettre de changer de langue à l’installation
- #5879 Diminuer le niveau de log (debug) des fichiers introuvables de `find_in_theme()`
- #5961 Correction du bandeau de l’espace privé pour les navigateurs sans `:has` encore par défaut (FF 115 ESR notamment)
- #5972 Ne pas ajouter une requête SQL de comptage lorsque non nécessaire
- #5972 Correction de `sql_countsel()` avec des groupby multiples en SQLite.
- !5999 Warning dans `http_img_pack` si le fichier n’existe pas
- #5970 Correction des boucles paginées sans limites (suite à !5911 #5714)
- #5960 Affichage du bandeau haut lorsqu’il n’y a pas d’outils collaboratifs activés
- #5758 Pipelines `pre_edition` et `post_edition`: transmettre l’info `objet` qui manque à quelques endroits (note: l’info `type` équivalente sera dépréciée en SPIP 5)
- #3581 Ne pas utiliser la fonction dépréciée `debut_cadre_sous_rub`
- !5989 Le filtre `inserer_attribut` utilise l’échappement `attribut_url` (plutôt que `attribut_html`) sur les attributs `href` et `src`
- #5549 Respecter le margin bottom sur le dernier element des formulaires
- Mise à jour des chaînes de langues
- !5982 Utiliser le modèle de pagination privé sur la liste des articles de même rubrique de l’espace privé
- !5984 Corriger l’authentification SPIP sur un serveur distant
- !5985 Correction du nombre total de pages des paginations de l’espace privé (sur le dernier item sur les listes longues)
- #5965 La balise `#FILTRE` gère le cas de filtres nécessitant la pile de contexte en argument.
- !5983 Pas de tabulations dans le mail de notification de mises à jour
- #5178 Englober la page login d’une `div.contenu_login` pour pouvoir être ciblée spécifiquement en CSS lorsque chargée dans une modale

## 4.3.0-beta - 2024-06-07

### Security

- Mise à jour de l’écran de sécurité en version 1.6.1

### Added

- #5774 Pipeline `get_spip_doc` pour manipuler le résultat natif de la fonction `get_spip_doc()`

### Fixed

- !5981 Ne pas afficher qu’une mise à jour est disponible alors qu’elle vient d’être faite !
- #5953 Les modèles de formulaires doivent être encadrés d’une balise `div` (retiré par erreur dans !5956 pour spip-team/securite#4853)

## 4.3.0-alpha2 - 2024-05-29

### Security

- spip-team/securite#4853 Appliquer un filtre `attribut_url()` aux endroits pertinents
- spip-team/securite#4853 Pouvoir rendre statique les modèles de formulaires dans certains contextes
- Mise à jour de l’écran de sécurité en version 1.6.0

### Added

- #5912 Filtre `|propre` qui applique `propre()` & `safehtml()` (cela permet de dés-échapper le code de confiance des modèles).
- spip-team/securite#4853 Filtre `attribut_url()` pour formater des attributs `href` et `src`

### Fixed

- #5939 #5156 Rétablir la possibilité de masquer certains champs des formulaires d’articles et de rubriques via le pipeline `formulaire_charger`
- #5667 Corriger la conformité HTML5 (quelques fonctions n’auraient pas du être modifiées)
- #5805 Éviter une fatale depuis `echapper_html_suspect()`, qui initialisait une valeur de `connect` incorrecte.
- #5667 Correction de `inserer_attribut()` sur un cas dérogatoire : les balises `<img>` (même non autofermante)
- !5969 Correction de coquille sur la meta charset (suite à la conformité HTML5)
- !5962 Petite optimisation sur `svg_nettoyer()`
- #5714 Optimisation des boucles avec pagination, en forçant une clause limit automatique dessus

## 4.3.0-alpha - 2024-05-07

### Added

- #5439 Le formulaire d’identité du site permet de configurer la `timezone` utilisée
- #5459 La constante `_DEBUG_MINIPRES` définie à `true` active l’affichage d’un debug visible lorsqu’une erreur de type `Minipage` survient
- !5913 Débugueur: Afficher le nombre d’occurrences et temps total des inclusions de squelettes
- #5454 Ajouter une option `find_all_in_path()` pour renvoyer tous les fichiers répondant à un pattern
- #5660 Nouveau filtre `|balise_img_svg` pour insérer une image ou un SVG inline sans savoir d'avance le format
- #5690 Afficher un encart pour signaler les nouvelles versions dans toutes les pages de l'espace privé pour les webmestres, et un bouton pointant vers `spip_loader` s'il est présent
- #3432 Notifier par email les webmestres du site lorsque SPIP dispose d’une mise à jour
- !196 Améliorer l’ergonomie du formulaire instituer (changement de statut d’un objet éditorial)

### Changed

- #5922 Le bandeau de navigation de l’espace privé est réduit en hauteur (2 lignes au lieu de 3)
- #4766 Le menu de création rapide passe en menu déroulant avec des labels explicites
- #3145 Écriture plus inclusive de certaines formulations
- #4994 Dans un plugin, si l’attribut logo d’un `paquet.xml` est absent, et qu’il existe un fichier `{prefixe}.svg` dans le plugin, il est utilisé comme logo
- !5540 Les fonctions `extraire_balise` et `extraire_balises` peuvent gérer des balises imbriquées

### Fixed

- #5667 Améliorer la conformité HTML5
- #5897 Icône Tâches de fond qui n'évoque pas les bases de données
- !5264 Refactoring de ecrire_fichier
- #4209 Combinaison des critères pagination et limit
- #4921 Ne pas conserver un double des fichiers calculés inchangés (`#PRODUIRE_FOND`)

### Deprecated

- #3581 Déprécier les fonctions désuettes de `ecrire/inc/presentation`
- #5199 La globale `auteur_session` (dépréciée depuis SPIP 2.0 !) sera supprimée en SPIP 5.0. Utiliser `visiteur_session`.
- #4857 Déprécier la classe `.label` au profit de `.editer-label` dans les formulaires

### Removed

- #4750 Retrait des options d'affichage des icones dans les préférences
