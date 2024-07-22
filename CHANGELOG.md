# Changelog

Changelog de SPIP 4.4

## Unreleased

### Fixed

- !5999 Warning dans `http_img_pack` si le fichier n’existe pas
- #5970 Correction des boucles paginées sans limites (suite à !5911 #5714)
- #5960 Affichage du bandeau haut lorsqu’il n’y a pas d’outils collaboratifs activés
- #5758 Pipelines `pre_edition` et `post_edition`: transmettre l’info `objet` qui manque à quelques endroits (note: l’info `type` équivalente sera dépréciée en SPIP 5)
- #3581 Ne pas utiliser la fonction dépréciée `debut_cadre_sous_rub`
- !5989 Le filtre `inserer_attribut` utilise l’échappement `attribut_url` (plutôt que `attribut_html`) sur les attributs `href` et `src`
- #5549 Respecter le margin bottom sur le dernier element des formulaires
