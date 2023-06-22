# Changelog

Changelog de SPIP 4.2

## Unreleased

### Fixed

- Éviter un `Call to undefined function session_get`
- #5636 Correction typage arguments de `objet_type`, `table_objet` et `table_objet_sql`
- #5627 Prévenir une ambiguité de certains squelettes (pour préparer SPIP 5) sur les balises simples utilisant `url(#BALISE)`. Utiliser `url("#BALISE")` ou `url\(#BALISE)`
- #5104 Éviter une erreur fatale quand un job ne peut pas récupérer les arguments de la callback associée
- #5341 Éviter une fatale sur le retour non booléen des fonctions `autoriser()` pour aider à nettoyer le code
- #5342 Éviter un warning dans ecrire
- #4697 Quand une URL de redirection contient une querystring avec des crochets, les encoder pour générer l'URL affichée
- #5240 Tester la variable  plus tôt pour éviter un warning
- #5451 Lien vers l'URL/mail de suivi éditorial suivant le format
- #5446 Inconsistance dans l'UX et le label de l'adresse d'inscription au suivi éditorial
- #4711 Optimisation pour latex & math
- #5615 Ne pas considérer un texte malicieux s’il a simplement une entité html
- #5570 Inclusion manquante sur charger_fonction() en échec

## 4.2.3 - 2023-06-07

### Security

- #5109 #5432 spip-team/securite#4844 Bloquer correctement les fichiers cachés dans le htaccess proposé
- #5552 Appliquer l’option `httponly` sur la plupart des cookies internes à SPIP
- #5552 Appliquer l’option `secure` sur les cookies lorsqu’on est en HTTPS
- spip-team/securite#4840 Éviter `unserialize` dans l’écran de sécurité
- spip-team/securite#4840 Limiter la profondeur de recursion de `protege_champ`
- spip-team/securite#4840 Inclure l’écran de sécurité avant l’autoloader
- spip-team/securite#4841 Limiter l’usage de `#ENV**` dans les formulaires.

### Added

- #5586 Attributs `data-objet`, `data-id_objet` et `data-objet-source` sur le formulaire d’édition de liens, pour usage en JS à toutes fins utiles.
- #5535 Log des dépréciations, via la fonction `trigger_deprecation` (de symfony/deprecations-contracts).
- #5301 Permettre de fournir le nom de l’attachement à `spip_livrer_fichier()`

### Changed

- Mise à jour de Sortable.js (1.14.0 => 1.15.0)
- #5542 Refacto page de contrôle et boîtes des tâches de fond

### Fixed

- Erreur Fatale en PHP 8.2 (Operand type) sur `plugins_afficher_nom_plugin_dist()`
- spip-galaxie/trad.spip.net#8 Calcul d’URL de `generer_url_api` sans précision du paramètre `public`
- #5603 Déclaration propre du pipeline notifications_destinataires
- #5573 Éviter un Deprecated sur la fonction d’import CSV
- #5563 Filtre `couper` erroné dans certains cas avec des caractères utf8 multi bytes.
- Formulaire de configuration du multilinguisme (suite à spip-team/securite#4841)
- #5584 Présentation de l’input de recherche dans l’ajout d’auteurs liés
- #5580 Recherche et navigation dans le sélecteur de rubriques dépliant
- #5496 Typage en entrée de certains paramètres des fonctions `generer_*` lorsque l’objet n’existe pas.
- #5571 Retrouver correctement les anciens itérateurs
- #5543 Indiquer la bonne fonction dans le message d'erreur de `_imagecreatefrom_func`
- #5317 Animation plus douce des formulaires resoumis hors ajax
- #5541 Notices PHP en moins sur la page de contrôle des tâches de fond
- #5485 Correction d’erreurs des traitements d’image si la balise `img` n’a pas d’attribut `src`
- #5426 Correction des filtres de date lorsque l’entrée ne précise pas le jour tel qu’avec `2023-03`


## 4.2.2 - 2023-02-28

### Fixed

- #5172 Éviter une erreur fatale sur `#INTRODUCTION` d'un objet inexistant
- #5513 Éviter une erreur fatale sur le critère `datapath` d’une boucle DATA lorsqu’il ne trouve pas de données.

## 4.2.1 - 2023-02-27

### Changed

- Mise à jour des chaînes de langues depuis trad.spip.net

### Fixed

- spip-team/securite#4839 Sanitizer toutes les valeurs passées aux formulaires
- Appel d’itérateurs dont le paramètre est un nom d’itérateur natif (bug plugin Critères précédent suivant)


## 4.2.0 - 2023-02-23

### Fixed

- #5500 Éviter une erreur de squelette quand on passe une valeur `null` à `|inserer_attribut`
- #5483 Ne pas appliquer `find_in_path` si le script du pipeline jquery_plugins pointe vers `_DIR_VAR`
- #5492 Ne pas être trompé par le width et le height d'une image haute densité quand on veut la retailler/reduire
- #5479 Ne pas injecter le port du proxy dans le http_host du site demandé
- #5487 Meilleure gestion de l’affichage des mises à jour
- #5476 Éviter un débordement des colonnes dans l’espace privé

### Added

- #5447 `exporter_csv()` accepte 2 nouvelles options `fichier` et `extension`


## 4.2.0-alpha2 - 2023-01-28

### Fixed

- #5472 Compatibilité PHP 7.4 (attribut SensitiveParameter à la ligne…)


## 4.2.0-alpha - 2023-01-27

### Security

- #5465 Masquer du debug PHP certains paramètres de fonctions (Attribut SensitiveParameter pour PHP 8.2+)
- spip-team/securite#4836 Refactoring de la gestion du oups du formulaire editer_liens
- spip-team/securite#3724 #5150 Le core ne génère plus de champ htpass par défaut dans `spip_auteurs`. Utiliser le plugin Htpasswd https://git.spip.net/spip-contrib-extensions/htpasswd pour ce besoin.

### Added

- #5452 #5469 Classes `Spip\Afficher\Minipage\Page` et `Spip\Afficher\Minipage\Admin` pour l’affichage des mini pages
- #3719 Permettre l’édition d’un logo (comme un document) dans l’interface privé
- #3719 Balise `#ID_LOGO_` (tel que `#ID_LOGO_ARTICLE`) retourne l’identifiant du document utilisé pour le logo d’un objet
- #4874 Normaliser et appeler l'API de notifications systématiquement sur la modification des contenus éditoriaux
- #5380 Classes CSS utilitaires pour placer des éléments en sticky dans l'espace privé
- #5056 Chargement de l’autoloader de Composer aux points d’entrées de SPIP
- #5056 Intégration de dépendances à des librairies PHP via composer.json (notamment les polyfill PHP 8.0 8.1 et 8.2 ainsi que le polyfill mbstring)
- #5323 Ajout de liens de retour vers le site public + déconnexion dans un des écrans d'erreur d'accès à l'espace privé
- #5302 Afficher la langue des utilisateurs sur leur page et permettre aussi de l'éditer
- #5271 Fonction `is_html_safe()`
- #4877 La balise `#TRI` permet d'alterner le sens du critère `tri`

### Changed

- #5452 #5469 Styles CSS et balisage HTML des mini pages (minipres) et de l’installation
- #5456 Brancher `info_maj()` sur les données de supported-versions
- #5433 Déplacement des 2 formulaires oubli et mot_de_passe dans le core
- #5402 Déplacement du `#FORMULAIRE_INSCRIPTION` directement dans le core
- #5086 Le filtre de date `recup_heure()` sait extraire `hh:mm` en plus de `hh:mm:ss`
- #5046 Le filtre `taille_en_octets()` retourne par défaut des unités cohérentes (en kio, Mio… )
- #5056 SPIP nécessite certaines dépendances via Composer (son archive zip contiendra le nécessaire)
- #5056 Les (quelques) classes PHP de SPIP sont déplacées dans `ecrire/src` sous le namespace `Spip`
- #5361 Image `loader.svg` dans un style plus moderne
- #5351 Balisage html généré par la balise raccourci `<code>`
- #5321 Refactoring de la collecte et echappement des liens
- #5271 Refactoring de la mise en sécurité des textes dans ecrire et public
- #5189 Ne plus forcer l'Engine MySQL à l'installation
- #5272 Compatibilité avec PHP 8.2
- #5025 Prise en charge de l'utf8 pour le filtre `|match` en appliquant par défaut le modificateur u (PCRE_UTF8)
- spip-team/securite#4835 utiliser json_decode au lieu de serialize pour _oups dans le formulaire d'edition de liens
- #5203 La balise `#CHAMP_SQL` peut expliciter une jointure tel que `#CHAMP_SQL{rubrique.titre}`
- #5156 Les squelettes des formulaires d’édition (`formulaires/editer_xxx.html`) ne reçoivent plus l’ensemble du contenu de `spip_meta` dans l’entrée d’environnement `config`. Utiliser `#CONFIG` dedans si besoin pour cela. Seules les données spécifiques au formulaire sont transmises (par les fonctions `xxx_edit_config()`)
- Ne pas insérer de balise de fermeture PHP dans le fichier `config/connect.php`
- #5082 Ne pas autoriser à refuser ses propres articles en tant que rédacteur ou rédactrice.
- #5042 Introduction de `README.md` et `LICENSE` (en remplacement de `INSTALL.txt` et `COPYING.txt`)
- #4881 suppression des globales `flag_*` et adaptation ou nettoyage en conséquence du code.
- #5108 `id_table_objet()` typé comme `objet_type()` que la fonction appelle

### Fixed

- #5292 Déprecated `utf8_encode` en PHP 8.2
- #5432 Rétablir l'accès à `.well-known/` dans certaines configurations serveur
- #5449 Aligner le comportement du filtre `|image_reduire` sur celui de GD quand on utilse convert
- #5430 Correction du chargement des boucles DATA.
- #5422 correction du filtre `|couper` dans les cas aux limites
- #5366 spip/dist#4857 Les blocs de code avec des lignes trop longues retournent à la ligne dans l’espace privé (comme dans le public)
- #5418 Le filtre `modifier_class` accèpte tous les caractères
- #5357 Intitulé plus explicite du formulaire d’inscription
- #5423 Ajouter les headers `Last-Modified` et `Etag` quand on livre un fichier
- #5035 Éviter une erreur unserialize dans `lister_themes_prives()`
- #5358 Vérifier et caster en `int` les width et height des balises d’image pour les traitements graphiques.
- #5405 Nécessiter l’extension PHP json.
- #5366 Afficher le langage (si précisé) des blocs de code, dans l’espace privé
- #5362 Agrandir le formulaire de recherche des listes dans l’espace privé
- #5357 Utiliser le terme "Se connecter" valider le formulaire de login
- #5355 Correction d'un Warning si le débogueur est appelé sans être connecté
- #5326 Utilisation de PHP_AUTH avec d'autres méthodes d'identification que LDAP
- #5329 Rétablir la collecte des doublons par la fonction `traiter_modeles()`
- spip-contrib-extensions/mailsubscribers#23 La séléction de la langue du visiteur doit se limiter à la config `langues_multilingue` dans le public
- spip/medias#4905 Utiliser une déclaration moins prioritaire pour les traitements sur les champs
- #4016 Utiliser de préférence `#VALEUR{index}` dans le core
- #5157 Deprecated en moins sur `_couleur_hex_to_dec()`, `couleur_html_to_hex()` & `url_absolue()`  quand on leur passe une valeur nulle
- #5274 Homogénéiser les labels des listes

### Deprecated

- #5452 Fonction `minipres()` au profit de `Spip\Afficher\Minipage\Admin` ou `Spip\Afficher\Minipage\Page`
- #5056 Les classes de nœud du compilateur (Champ, Boucle, Critere...) sont déplacées dans le namespace `Spip\Compilateur\Noeud\` (l’appel sans namespace est déprécié)

### Removed

- #5285 Supprimer le lien obsolète vers `page=distrib` dans la page Suivre la vie du site
- #5278 Globales obsolètes `spip_ecran` et `spip_display`
- spip-team/securite#3724 #5150 Suppression de la fonction `initialiser_sel()` (qui ne servait que pour la gestion de htpasswd déportée en plugin).
