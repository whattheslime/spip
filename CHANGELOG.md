# Changelog

Changelog de SPIP 4.3

## Unreleased

### Added

- #5454 Ajouter une option `find_all_in_path()` pour renvoyer tous les fichiers répondant à un pattern
- #5660 Nouveau filtre |balise_img_svg pour insérer une image ou un SVG inline sans savoir d'avance le format
- #5690 Afficher un encart pour signaler les nouvelles versions dans toutes les pages de l'espace privé pour les webmestres, et un bouton pointant vers `spip_loader` s'il est présent
- #3432 Notifier par email les webmestres du site lorsque SPIP dispose d’une mise à jour
- !196 Améliorer l’ergonomie du formulaire instituer (changement de statut d’un objet éditorial)

### Changed

- !5540 Les fonctions `extraire_balise` et `extraire_balises` peuvent gérer des balises imbriquées

### Fixed

- !5264 Refactoring de ecrire_fichier
- #4209 Combinaison des critères pagination et limit
- #4921 Ne pas conserver un double des fichiers calculés inchangés (`#PRODUIRE_FOND`)
- #5916 Éviter un débordement du contenu des explications dans les formulaires de l'espace privé
- !5936 Éviter une erreur fatale sur la sécurisation d’une action sans hash
- #5910 Mieux tester l'unicité de l'email avec `_INTERDIRE_AUTEUR_MEME_EMAIL`
- #5909 Rétablir les autorisations calculées avec id_auteur=0
- #5906 Ne pas appliquer des traitements dans `email_valide()` si aucune adresse n'est transmise

### Deprecated

- #4857 Deprecier la classe `.label` au profit de `.editer-label` dans les formulaires
- #5885 fonction `formulaire_recherche()`
