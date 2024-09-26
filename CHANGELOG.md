# Changelog

Changelog de SPIP 4.4

## Unreleased

### Security

- Mise à jour de l’écran de sécurité via composer
- Mise à jour de l’écran de sécurité en version 1.6.3

### Added

- !6034 paramètre pour le filtre `|affdate{'Y-m-d H:i:s}`
- spip/medias#4958 Fonction `_image_extensions_logos()` et pipeline `image_extensions_logos`
- Les dossiers `prive/` et `squelettes-dist/` s'installent avec composer
- #5938 Permettre à `objet_info()` de retourner directement l’information `table_objet_sql` (le nom de la table sql)

### Changed

- #5979 Revert du calcul automatique des chaînes de langue du menu Créer du bandeau de l’espace privé

### Fixed

- !6047 Correction de certains envois de fichiers (notamment audio) via `spip_livrer_fichier`
- #3919 Réparer l'ajout de la configuration LDAP lors de l'installation
- #3928 Les emails des auteurs sont masqués par défaut
- !6024 Éviter notice dans `init_http` en cas de "seriously malformed URLs"
- #5983 (retour partiel sur #5667) Générer des contenus éditoriaux aussi compatibles xhtml (sur `br` et `img`)
- !6016 Afficher aussi dans l’espace privé le tableau des requêtes du mode `var_profile=1`
- #5979 Modifier les chaînes de langues utilisées pour les objets déclarés dans le menu Créer (article, rubrique, auteur)

### Deprecated

- #5992 Modifier la globale `$formats_logos` est déprécié : utiliser le pipeline `image_extensions_logos`
- #5992 Appeler la globale `$formats_logos` est déprécié, utiliser la fonction `_images_extensions_logos()`
