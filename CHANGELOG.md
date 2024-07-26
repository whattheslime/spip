# Changelog

Changelog de SPIP 4.4

## Unreleased

### Security

- Mise à jour de l’écran de sécurité en version 1.6.2

### Added

- #5938 Permettre à `objet_info()` de retourner directement l’information `table_objet_sql` (le nom de la table sql)

### Fixed

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
