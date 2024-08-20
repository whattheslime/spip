# Changelog

Changelog de SPIP 4.1

## Unreleased

### Security

- Mise à jour de l’écran de sécurité en version 1.6.3

## 4.1.17 - 2024-06-07

### Security

- Mise à jour de l’écran de sécurité en version 1.6.1

### Fixed

- #5953 Les modèles de formulaires doivent être encadrés d’une balise `div` (retiré par erreur dans !5956 pour spip-team/securite#4853)

## 4.1.16 - 2024-05-29

### Security

- spip-team/securite#4853 Appliquer un filtre `attribut_url()` aux endroits pertinents
- spip-team/securite#4853 Pouvoir rendre statique les modèles de formulaires dans certains contextes
- Écran de sécurité en version 1.6.0

### Added

- spip-team/securite#4853 Filtre `attribut_url()` pour formater des attributs `href` et `src`

## 4.1.15 - 2024-01-12

- Cf. plugin Bigup

## 4.1.14 - 2024-01-11

- Cf. plugin Bigup

## 4.1.13 - 2023-12-18

### Security

- spip-team/securite#4849 Éviter une XSS via l’appel de certains modèles


## 4.1.12 - 2023-09-01

- Cf. plugin SVP

## 4.1.11 - 2023-07-07

### Security

- spip-team/security#4847 Limiter les données d’authentification des auteurs via une fonction `auth_desensibiliser_session()`

### Fixed

- #5569 Les filtres de transformation de texte acceptent une valeur null
- Éviter un `Call to undefined function session_get`

## 4.1.10 - 2023-06-07

### Security

- #5109 #5432 spip-team/securite#4844 Bloquer correctement les fichiers cachés dans le htaccess proposé
- spip-team/securite#4840 Éviter `unserialize` dans l’écran de sécurité
- spip-team/securite#4840 Limiter la profondeur de recursion de `protege_champ`

### Fixed

- #5411 Éviter un deprecated sur le filtre `|replace`
- #5496 Typage en entrée de certains paramètres des fonctions `generer_*` lorsque l’objet n’existe pas.
- #5485 Correction d’erreurs des traitements d’image si la balise `img` n’a pas d’attribut `src`
- #5426 Correction des filtres de date lorsque l’entrée ne précise pas le jour tel qu’avec `2023-03`
- #5449 Aligner le comportement du filtre `|image_reduire` sur celui de GD quand on utilse convert

## 4.1.9 - 2023-02-28

### Fixed

- #5172 Éviter une erreur fatale sur `#INTRODUCTION` d'un objet inexistant

## 4.1.8 - 2023-02-27

### Changed

- #5456 Brancher `info_maj()` sur les données de supported-versions

### Fixed

- spip-team/securite#4839 Sanitizer toutes les valeurs passées aux formulaires
- #5500 Éviter une erreur de squelette quand on passe une valeur `null` à `|inserer_attribut`
- #5487 Meilleure gestion de l’affichage des mises à jour
- #5432 Rétablir l'accès à `.well-known/` dans certaines configurations serveur

## 4.1.7 - 2023-01-13

### Fixed

- spip/dump#4721 Correction de la sauvegarde Mysql


## 4.1.6 - 2023-01-13

### Changed

- #5273 Le critère `par_ordre_liste` rejette à la fin les éléments de la boucle absents de la liste
- #5016 Généralisation du traitement des balises dynamiques dans un modèle

### Fixed

- #5445 Permettre d'insérer plusieurs adresses séparées par des virgules dans le formulaire de configuration des annonces de nouveautés
- #5398 Inclusion manquante lors de certains traitements d’image SVG
- #5424 Utiliser un délai de 48 h et non pas de 48 jours pour vider les contextes Ajax
- #5379 spip/medias#4873 Pouvoir soumettre le formulaire de recherche privé avec la touche entrée.
- #5358 Vérifier et caster en `int` les width et height des balises d’image pour les traitements graphiques.
- #5076 Réparer (mieux) le retour de `lister_objets_lies()` sur les tables qui ont un `rang_lien`
- #5404 Déplacement de rubrique (en SQLite, sans le plugin Brèves)
- #5316 Les PDF envoyés avec un CSP Sandbox ne sont pas visibles dans Safari ou Chrome, on fait donc une exception pour ces fichiers
- #5328 #5368 Réparer le lien vers la licence GPL dans le pied des pages du privé
- #5284 Éviter que les titres longs dépassent de leur bloc dans l'espace privé
- #5308 Correction de la valeur affichée pour le dernier item de pagination en mode naturel
- #5132 Correction d'un deprecated sur `recuperer_numero()` quand on lui passe une valeur nulle
- #5287 Éviter un échec de migration de certains logos au format SVG.
- #5283 Loger les erreurs de squelettes lorsqu’elles ne sont pas affichées sur la page
- #5016 Collecte des arguments sur les formulaires dans un modèle


## 4.1.5 - 2022-07-21

### Fixed

- #5303 Ne pas déclencher l'ouverture du datepicker quand la date n'est pas en édition
- #5228 Rétablir le filtrage des valeurs `null` envoyées à la fonction `objet_modifier_champs()`
- #5223 Éviter une erreur fatale sur `sql_selectdb()` sur une base inexistante en mysql
- #5218 Éviter l’autocomplétion d’identifiants email en éditant un auteur
- #5209 #5221 Fonctionnement de Imagick sous Windows
- #5206 Échouer en minipres si on ne peut pas écrire le fichier des clés lors du login
- #5213 Prendre en compte le sens du critère `tri` en présence d’un tri `multi`

## 4.1.4 - 2022-07-21

### Fixed

- #5259 Fatale sur `autoriser` appelé avec un identifiant d’auteur inexistant
- Installation de SPIP 4.1.3

## 4.1.3 - 2022-07-21

### Security

- #5256 Bloquer la modification d'un auteur via une XMLHttpRequest ou une iframe
- spip-team/securite#4832 Envoyer un CSP sandbox sur tous les documents de IMG via une RewriteRule du htaccess.txt modèle
- spip-team/securite#4835 Mise a jour de l'écran de sécurité en version 1.4.2
- spip-team/securite#4835 Sécuriser le paramètre `_oups` dans le formulaire d'édition de liens
- spip-team/securite#4833 Signaler visuellement les liens javascript dans les zones éditoriales
- spip-team/securite#4831 Correction des traitements des balises `#INFO_` dans l’espace privé

### Added

- spip-team/securite#4832 spip-team/securite#4833 une fonction `auth_controler_password_auteur_connecte()` pour securiser une action

### Fixed

- #5312 Bug sur la sélection rapide par id dans le selecteur générique
- #5256 Correction de `#HTTP_HEADER{}` quand la valeur contenait un simple quote
- #5256 Corriger `refuser_traiter_formulaire_ajax()` qui ne fonctionnait pas quand un form contenait un element avec un name ou id `submit`
- spip-contrib-extensions/formidable#119 Échapper les noms de fichier quand on génère une balise img à l'aide du filtre `|balise_img`
- #4826 Vignettes fallback quand on ne sait par reduire la taille d'une image du fait de son format
- #5232 Correction notice PHP sur `signale_edition()`
- #5231 Correction deprecated PHP 8.1 sur `sql_quote(null)`
- #5242 Correction warning sur `generer_objet_lien()`
- #5239 Eviter une fatale sur un appel de `generer_objet_info()`
- spip-contrib-extensions/agenda#57 Éviter une erreur de typage à l’enregistrement dans certains formulaires
- #5190 Dans le formulaire de configuration de l'email de suivi, pouvoir indiquer une liste d'emails séparés par des virgules
- #5204 Fix le login lors de la restauration des cles depuis un compte webmestre
- #5118 Fix les viewbox erronnées lors de la copie locale des SVG sans viewbox
- #5194 Améliorer le comportement du bouton "Ajourd'hui" dans le dateur en surlignant le jour courant + ajout option data-todayhighlight sur les input.date + fix option data-clearbtn


## 4.1.2 - 2022-05-20

### Security

- spip-team/securite#4829 Sécuriser le retour de `nettoyer_titre_email()` lorsqu’utilisé en squelette (Louka)
- spip-team/securite#4494 Suite de #54 : masquer aussi les cookies sensibles dans `$_SERVER['HTTP_COOKIE']` et `$_ENV['HTTP_COOKIE']` sur la page d’info
- spip-team/securite#3728 Sécuriser `HTTP_HOST` et `REQUEST_URI` dans `url_de_base()`
- spip-team/securite#3725 Reconnaitre les cookies securisés même si on utilise un `cookie_prefix`
- spip-team/securite#3703 Regexp de `_PROTEGE_BLOCS` plus robuste (`\b` plutôt que `\s`)
- spip-team/securite#3702 Sécuriser dans `parametre_url()` la construction d’une regexp
- spip-team/securite#3700 Éviter dans `preg_files()` une regexp qui retourne tous les fichiers
- spip-team/securite#3698 Sécuriser l’affichage des erreurs de plugins
- spip-team/securite#3609 Sécuriser l'usage des var_mode_xx dans le debuggueur
- spip-team/securite#3730 À l’installation (étape bdd), échapper le nom de la bdd
- spip-team/securite#3597 À l’installation (étape ldap), filtrer l’adresse LDAP et échapper les variables
- spip-team/securite#3596 À l’installation (étape test d’écriture), ne pas accepter `..` lors du test des répertoires

### Added

- #4277 Constante `_MYSQL_ENGINE` pour spécifier l’engine MySQL à utiliser
- Loger l'avancement de la migration des logos (lors d’une mise à jour)
- Permettre de debug (js) les erreurs sur les liens ajax en utilisant le flag `jQuery.spip.debug` pour désactiver la redirection automatique
- spip-team/securite#4336 La fonction `recuperer_infos_distantes()` accepte une option supplémentaire pour passer une callback de validation de l'URL distante finale (apres suivi des redirections eventuelles)
- spip-team/securite#3725 Permettre d'étendre la liste par défaut des cookies sécurisés via la constante `_COOKIE_SECURE_LIST`

### Changed

- Typage de la fonction `spip_affiche_mot_de_passe_masque()`
- Accélérer un peu la migration des logos en documents (sur mise à jour vers SPIP 4.0) en désactivant le versionnage et les drapeaux édition pendant cette étape
- spip-team/securite#4336 La fonction `recuperer_infos_distantes()` prend maintenant un tableau d'options en second argument (seul le core utilisait les 2nd et 3e arguments).
- spip-team/securite#4336 La fonction `recuperer_infos_distantes()` accepte une option supplémentaire pour passer une callback de validation de l'URL distante finale (apres suivi des redirections eventuelles)
- spip-team/securite#4336 La fonction `copie_locale()` accèpte un argument `$callback_valider_url` qui permet de tester l'URL finale après récuperation et de refuser la copie locale si l'URL ne valide pas

### Fixed

- #4277 Adaptation de `spip_mysql_repair()` à innodb
- #4277 Permettre de spécifier l'engine mysql à utiliser
- #5095 Ne pas casser une meta sérialisée quand un utilisateur saisit un emoji dans un formulaire de configuration
- #5152 Éviter des warning si `spip_log()` est appelé avant l’initialisation (dans mes_options)
- #5162 Erreur d’exécution sur `vider_date()` qui doit renvoyer une chaine
- Correction notice PHP sur `spip_affiche_mot_de_passe_masque()` en absence de mot de passe
- #5169 Éviter une erreur JS sur `$.fn.positionner()` si la sélection est vide
- #5168 Éviter une erreur fatale sur `analyse_fichier_connection()` si le fichier de connexion à analyser n’existe pas
- #5101 Le statut de rubrique par défaut à tester est désormais `prepa` plutôt que `new`
- #5183 Éviter de générer des icones trop grandes dans la liste des articles syndiqués
- #5185 Éviter une double compression des JS de la page login
- Correction de la navigation par initiale sur les listes auteurs et visiteurs (bon markup de pagination)
- Correction warning sur un log dans `logo_supprimer()`
- Correction nom de option `expires` (qui est bien avec un s comme l'entete http qu'on envoie) dans `spip_livrer_fichier()`
- Correction erreur de typage quand on utilise la fonction dépréciée `generer_url_entite_absolue()`
- #5155 Suppression de l'argument `formulaire_action_sign` de l'url d’action des formulaires
- #5148 Centrer l'image de fond de la page login
- #5117 Éviter un warning à l’installation sur l’absence de configuration de 'articles_modif'
- spip-team/securite#4336 La fonction `copie_locale()` ne retourne un chemin local que s’il existe
- #5121 CHANGELOG.md dans un format markdown suivant https://keepachangelog.com/fr/1.0.0/
- #5115 Éviter un warning lors de l'appel avec un tableau à `produire_fond_statique()`

### Removed

- #5110 Depuis #5018, le fichier `prive/transmettre.html` n’a plus lieu d’être.


## 4.1.1 - 2022-04-01

### Added

- Mise à jour des chaînes de langues depuis trad.spip.net

### Changed

- #5109 Il est recommandé de mettre les fichiers cachés en 404 (via le htaccess)

### Fixed

- #5109 bloquer l’accès aux fichiers de définition Composer (via le htaccess)
- Coquille dans `_SPIP_VERSION_ID` Nous sommes en version 4.1 ici, pas 41…
- Éviter des deprecated (null sur str*) lors de l’utilisation de `#CHEMIN{#ENV{absent}}`


## 4.1.0 - 2022-03-25

### Changed

- #5074 extension Sodium requise
- #5093 Revert partiel de #5048 (seul le fichier image svg d’objet générique est conservé)

### Fixed

- Simplification de `queue_start_job()` avec le spread operateur
- #5080 éviter que les paginations débordent sur petit écran
- #5076 réparer le retour de `lister_objets_lies()` sur des objets liés au même type d’objet
- #5100 JS pour eviter une double exécution sur un bouton action sur les doubles clic
- #5089 réparer l’affichage du mode debug en PHP 8 dans l’espace privé
- Éviter un warning sur `decompiler_criteres()`
- #5090 Afficher les logos auteurs et visiteurs de la même façon dans l’espace privé
- #5079 Suppression de la déclaration de la fonction `imagepalettetotruecolor()`
- Correction des paginations des boites qui listent les sous-rubriques
- #5088 Réparer le critère `compteur_articles_filtres` & sa balise `#COMPTEUR_ARTICLE`
- #5085 : Réparer le lien Afficher tout dans les paginations des boites de sous-rubriques


## 4.1.0-rc - 2022-03-05

### Added

- #5050 Fournir un fichier `.editorconfig`
- #5048 Icone d’objet générique `objet-generique-xx.svg`
- #5030 Indiquer la version max de PHP
- #5064 Champ `backup_cles` sur la table `spip_auteurs`
- #5064 Un fichier `config/cles.php` est généré
- Répertoire `ecrire/src` (en prévision d’un autoloader)
- Mise à jour des chaînes de langues depuis trad.spip.net

### Changed

- **Important** #5064 (Issues #5059 #4927 #3824 #2109) : changement de logique du login : plus de hashage + sel côté client, car les algos js sont pénibles à gérér et https est maintenant un standard de securité ;  côté serveur on utilise les fonctions modernes de PHP pour la gestion des mots de passe (sel, poivre, hashage et vérification) ; nécessite l’extension Sodium de PHP
- #5064 Les jetons d’action utilisent `hash_hmac` et `hash_equals` pour le calcul et la verification
- #5064 Les jetons en bdd sont hashés
- Homogénéisation des retours des filtres de dates : les filtres `|mois`, `|minutes`, `|annee` retournent toujours un string
- #4519 Nomages des paramètres et variables de listes d’inclusions et d’exclusions. On utilise `include list` et `exclude list` en anglais, et `liste d’inclusion` et `liste d’exclusion` en français
- #5048 `http_img_pack()` peut recevoir une clé `'alternative'` dans son tableau d'option. Cela indique une icone alternative à utiliser si jamais on ne retrouve pas l'image.

### Fixed

- #5069 les critères de date tel que `annee_nomprecis` fonctionnent aussi si le champ existe, mais qu’aucun champ `date` n’est déclaré.
- Capturer les `\ParseError` dans `evaluer_page()`
- `supprimer_tags()` acceptait des array contrairement à ce que supposait son phpdoc
- return manquant dans `spip_substr()`
- Différents warnings et notices corrigées
- Différentes simplifications de code avec PHP > 7.4 (notamment utilisation de variadics)
- Différents phpdoc complétés
- #5067 ne pas se rabattre sur les urls pages si un type d'url a été demandé explicitement

### Removed

- `lister_configurer()` et `lister_formulaires_configurer()`, Code mort depuis 11 ans (avant SPIP 3.0)


## 4.1.0-beta - 2022-02-18

### Security

- Bien appliquer l’autorisation dans `formulaires_editer_objet_charger()` (g0uz)

### Added

- Mise à jour des chaînes de langues depuis trad.spip.net

### Fixed

- #5040 Utiliser une fonction `lire_fichier_langue()` pour charger un fichier de langue et vérifier qu’il est correct. On loge une erreur sinon.
- Différents warnings, notices ou deprecated
- Optimisations et nettoyages pour PHP 7.4+, dont remplacement des `call_user_func` et `call_user_func_array` par des `$func($param)` ou `$func(...$params)`
- #5032 `ini_set()` peut être désactivé sur les hébergements web.

### Removed

- #5038 suppression de `signaler_conflits_edition()`, code mort depuis SPIP 3.0


## 4.1.0-alpha - 2022-02-08

### Added

- Compatibilité PHP 8.1
- Mise à jour des chaînes de langues depuis trad.spip.net
- #5018 Fonction `generer_url_api()` pour generer une url vers une action api
- #5018 Action d’api transmettre à utiliser sous la forme `transmettre.api/id_auteur/cle/format/fond?...` pour remplacer le vieux `transmettre.html` et les flux RSS lowsec
- #5018 Fonction `generer_url_api_low_sec()` pour faciliter la generation d'une url low_sec vers transmettre.api
- #5018 Fonction `securiser_acces_low_sec()` (renommage de `securiser_acces()`)
- #5018 Filtre `filtre_securiser_acces_dist()` (assure la retro-compatibilité des squelettes avec l’ancien nom de `securiser_acces_low_sec()`)
- #5010 Filtre `header_silencieux()` pour masquer la version de SPIP si la globale `spip_header_silencieux` le demande
- Une fonction `infos_image()` qui fait un peu plus que `taille_image()` en recupererant en meme temps le poids du fichier si possible (0 sinon), y compris en faisant une copie locale.
- Un filtre `poids_image()` retourne le poids d’une image (en s’appuyant sur `infos_image()`).
- #5000 Fonction `generer_objet_info()` (remplace `generer_info_entite()`) qui delegue maintenant à des fonctions `generer_objet_TRUC()` ou `generer_TYPE_TRUC()`
- #5000 Fonction `generer_objet_lien()` (remplace `generer_lien_entite()`)
- #5000 Fonction `generer_objet_introduction()` (remplace `generer_introduction_entite()`)
- #5000 Fonction `generer_objet_url()` (remplace `generer_url_entite()`) et on en profite pour separer public et connect en 2 arguments distincts
- #5000 Fonction `generer_objet_url_absolue()` (remplace `generer_url_entite_absolue()`)
- #5000 Fonction `generer_objet_url_ecrire()` (remplace `generer_url_ecrire_objet()`)
- #5000 Fonction `generer_objet_url_ecrire_edit()` (remplace `generer_url_ecrire_entite_edit()`)
- spip/medias#4853 Fonction `corriger_extension()` déplacée du plugin medias vers `inc/documents` du core
- #4974 Fonction `sql_table_exists()` pour vérifier qu’une table SQL existe…
- #4953 #4939 Connaitre le contenu avant modification des objets dans les pipelines `pre_edition` et `post_edition` en transmettant une information `champs_anciens` en plus
- Ajout de l’instruction `GREATEST` (de mysql) dans SQLite en la mappant sur `max()`.  L’instruction `LEAST` était déjà traité.

### Changed

- Nécessite PHP 7.4 minimum.
- Nécessite les extensions PHP Phar, Zip et Zlib (dépendances du plugin Archiviste 2.1+)
- #5019 Le filtre `alterner` peut recevoir un compteur negatif
- Typage sur certains arguments et retours de fonctions (dont `autoriser()`, dont `$connect` en type string)
- #5018 Déplacement des squelettes de prive/rss vers prive/transmettre/rss
- #5000 #3311 Fonctions de calcul et décodage d’URL réimplémentées
- Le composer.json (non utilisé encore en dehors du dev) indique la dépendance à PHP et ses extensions
- Mise à jour de jQuery Forms en version 4.3.0
- Mise à jour de JS Cookie passe en version 3.0.1
- Mise à jour de jQuery.form.js en version 4.3.0
- Mise à jour de Sortable.js en version 1.14.0

### Fixed

- Différents warnings et notices
- Différents PHPDoc complétés
- Différents nettoyages de code pour PHP 7.4+
- #4968 PHP 8.1 Attraper les exceptions mysqli.
- PHP 8.1 : Nombreux deprecated (particulièrement avec `null` sur des fonctions de chaînes de caractères)
- PHP 8.1 : Ne pas générer d’exception sur la boucle DATA avec du json si celui-ci est erronné.
- PHP 8.1 : Éviter une erreur fatale lorsqu’une erreur survient sur l’écriture d’un fichier et que `raler_fichier()` est appelé avant
- #5015 Amélioration du message d’erreur sur charger_fonction si le fichier est trouvé mais pas la fonction
- #5011 Toujours afficher les articles refusés d'une rubrique
- Correction du fichier de DTD de paquet.xml
- #4945 Autoriser d'autres espaces que l'espace dans les critères `{a,b}`
- #4986 Refactoring de la gestion des options headers/datas de `recuperer_url()` pour mieux gérer certaines redirections
- #4974 Ne pas générer une erreur SQL et un log d’erreur simplement pour tester la présence d’une table
- #4913 Journalisation : ajout de l'id et du nom de l'auteur, correction du message
- Permettre de reset `query_echappe_textes()` quand on fournit un uniqid, pour les tests unitaires
- #4870 Tenir compte de `_PASS_LONGUEUR_MINI` pour la génération de mots de passe
- spip-contrib-extensions/crayons#10 inclure les fichiers de fonctions avant d'appliquer les traitements d’une balise via `appliquer_traitement_champ()`

### Deprecated

- #5018 Fonction `param_low_sec()` (utiliser `generer_url_api_low_sec()`)
- #5000 Fonction `generer_info_entite` (utiliser `generer_objet_info()`)
- #5000 Fonction `generer_lien_entite` (utiliser `generer_objet_lien()`)
- #5000 Fonction `generer_introduction_entite` (utiliser `generer_objet_introduction()`)
- #5000 Fonction `generer_url_entite` (utiliser `generer_objet_url()`)
- #5000 Fonction `generer_url_entite_absolue` (tiliser `generer_objet_url_absolue()`)
- #5000 Fonction `generer_url_ecrire_objet` (tiliser `generer_objet_url_ecrire()`)
- #5000 Fonction `generer_url_ecrire_entite_edit` (tiliser `generer_objet_url_ecrire_edit()`)
- Fonction `http_status()` (utiliser la fonction native `http_response_code()`)

### Removed

- Compatibilité PHP 7.3
- #5018 Suppression de prive/rss.html
- Fichiers `prive/transmettre/forum_article.html` et `prive/transmettre/signatures_article.html`, code mort depuis 10 ans
- Code mort : on n’a plus à gerer l'appel des vieilles fonction d'URL SPIP < 2
- #4875 Retrait de `#FORMULAIRE_CONFIGURER_METAS` (code mort depuis SPIP 3)
- Suppression de la compatibilité `jQuery.cookie` ou `$.cookie` (utiliser `Cookies.get` ou `Cookies.set`)
