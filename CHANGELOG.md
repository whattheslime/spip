# Changelog

Changelog de SPIP 4.4

## Unreleased

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
