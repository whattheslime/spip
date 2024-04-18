# Changelog

Changelog de SPIP 4.3

## Unreleased

### Fixed

- #4921 Ne pas conserver un double des fichiers calculés inchangés (`#PRODUIRE_FOND`)
- #5916 Éviter un débordement du contenu des explications dans les formulaires de l'espace privé
- !5936 Éviter une erreur fatale sur la sécurisation d’une action sans hash
- #5910 Mieux tester l'unicité de l'email avec `_INTERDIRE_AUTEUR_MEME_EMAIL`
- #5909 Rétablir les autorisations calculées avec id_auteur=0
- #5906 Ne pas appliquer des traitements dans `email_valide()` si aucune adresse n'est transmise

### Deprecated

- #5885 fonction `formulaire_recherche()`
