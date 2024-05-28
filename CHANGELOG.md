# Changelog

## Unreleased

### Security

- spip-team/securite#4853 Pouvoir rendre statique les modèles de formulaires dans certains contextes

### Added

- !5824 Logger `spip_logger()` impplémentant `Psr\Log\LoggerInterface` (PSR-3) via une librairie `spip/logger` qui utilise Monolog
- !5807 Cache des squelettes réécrit en utilisant une librairie `spip/cache` (PSR-16)
- !5806 Gestion des chemins (path) & leur cache réécrit en utilisant une librairie `spip/path`
- #5565 Critère `{collate}` (remplace `{collecte}`)
- #5565 Critères `{groupby}` et `{groupby_supprimer}` (remplace `{fusion}` et `{fusion_supprimer}`)
- #5565 Critère `{having}`
- Les plugins-dist et le squelettes-dist s'intallent avec composer

### Changed

- #4657 Renommage de `admin_tech` en `admin_bdd` et des chaînes de langue afférentes
- !5708 Découpage des fichiers de démarrage de SPIP (non surchargeables) dans `ecrire/boostrap`
- !5765 Nettoyage des paramètres d’URI : la constante `_CONTEXTE_IGNORE_LISTE_VARIABLES` remplace `_CONTEXTE_IGNORE_VARIABLES` supprimée.
- #3637 Phraseur: Accepter des crochets dans la partie optionnelle d’une balise. `[hop] (#REM) [truc]` devient possible.
- Refactor de `echappe_html()` avec un collecteur
- #5552 Signature de `spip_setcookie` (reprend la signature de php `setcookie`)
- Les logos historiques (migrés en documents à partir de SPIP 4.0) ne sont plus utilisés s’il en restait.
- #5898 Nécessite PHP 8.2 minimum

### Fixed

- #5667 Correction de `inserer_attribut()` sur un cas dérogatoire : les balises `<img>` (même non autofermante)
- !5962 Petite optimisation sur `svg_nettoyer()`
- #5714 Optimisation des boucles avec pagination, en forçant une clause limit automatique dessus
- #5825 Ne pas mettre l'adresse du site entre parenthèses dans les mails envoyés par SPIP

### Deprecated

- !5824 Fonction `spip_log()`. Utiliser `spip_logger()` qui retourne une instance impplémentant `Psr\Log\LoggerInterface`
- Fichiers de langue peuplant une variable globale. Retourner directement un array (valide à partir de SPIP 4.1)
- Filtre/fonction `abs_url`. Utiliser `url_absolue` ou `liens_absolus` selon.
- Dans les fonctions `extraire_idiome` et `extraire_multi`, le 3è paramètre `$options` de type `bool` est déprécié. Utiliser un array `['echappe_span' => true]`
- #5552 Constantes `_COOKIE_SECURE` et `_COOKIE_SECURE_LIST` (utiliser les options `secure` et/ou `httponly` de `spip_setcookie`)
- #5565 Critère `{collecte}`. Utiliser `{collate}`
- #5565 Critères `{fusion}` et `{fusion_supprimer}`. Utiliser `{groupby}` et `{groupby_supprimer}`
- Fonction `logo_migrer_en_base()` (utilisable jusqu’en SPIP 5.y pour migrer les logos en documents)
- Fonction `spip_sha256` (utiliser `hash('sha256', $str)`)

### Removed

- #5199 Retrait de toutes les références à la globale `auteur_session`
- #5917 Retrait de toutes les références à NETPBM
- #5885 fonction `formulaire_recherche()`
- #5803 Fichier `ecrire/inc/json.php` et les vieilles fonctions de compatibilité json `json_export` et `var2js` : utiliser `json_encode` natif.
- !5890 Fichiers `ecrire/base/serial.php` et `ecrire/base/auxiliaires.php`, appeler la fonction de `base/objets` à la place.
- !5765 Constante `_CONTEXTE_IGNORE_VARIABLES` (string), utiliser `_CONTEXTE_IGNORE_LISTE_VARIABLES` (array)
- #5701 Retrait de la fonctionnalité de surlignage des résultats de la recherche. Cf. plugin Surligne <https://git.spip.net/spip-contrib-extensions/surligne>
- !5688 Ne plus chercher d’eventuels fichiers `ecrire/mes_options.php` ou `ecrire/inc_connect.php` (ils sont dans `config/mes_options.php` ou `config/connect.php`)
- #5654 Migration BDD < SPIP 4.0 (il faut partir d’un SPIP 3.2 minimum pour migrer en SPIP 5.0)
- #5652 Constante `_ID_WEBMESTRES` (dépréciée en SPIP 2.1). Utiliser le champ `webmestre` dans la table `spip_auteurs`.
- !5631 Balise `#EMBED_DOCUMENT` (déprécié en SPIP 2.0). Utiliser `#MODELE{emb, ...}`
- !5631 Balise & syntaxe `[(#EXPOSER|on,off)]` (dépréciée depuis SPIP 1.8.2). Utiliser `[(#EXPOSE{on,off})]`
- !5631 Syntaxes des `[(#FORMULAIRE_RECHERCHE|param)]` (dépréciée depuis SPIP 2.1). Utiliser `[(#FORMULAIRE_RECHERCHE{param})]`
- !5631 Syntaxes des `#LOGO_xx` avec de faux filtres `|left` `|right` `|center` `|bottom` `|top`, `|lien` `|fichier` (dépréciées depuis SPIP 2.1)
- Javascript `jquery.placeholder-label` (qui simulait l’attribut placeholder sur des vieux navigateurs)
- Suppression du test sur [mbstring.overload](https://www.php.net/manual/en/mbstring.configuration.php#ini.mbstring.func-overload) à l'install
- Suppression de l’usage de la classe `no_image_filtrer` (utiliser la classe `filtre_inactif` qui l’a remplacé)
- Fichier `plugins-dist.json` (on utilise `composer.json` maintenant)
- Boucle `POUR` (utiliser une boucle DATA tel que `<BOUCLE_x(DATA){source tableau, ...}>`)
- Filtre `icone` (utiliser probablement le filtre `icone_verticale`)
- Filtre `foreach` (utiliser une boucle `<BOUCLE_x(DATA){source table, #GET{tableau}}>...`)
- Action `super_cron` (utiliser l’action `cron`, tel que `spip.php?action=cron`)
- Fonction `inc_lister_objets_dist` (utiliser `recuperer_fond('prive/objets/liste/xxx')`)
- Fonction `critere_par_joint` (utiliser `calculer_critere_par_champ` si besoin)
- Fonction `http_status` (utiliser `http_response_code`)
- Fonction `generer_url_ecrire_objet` (utiliser `generer_objet_url_ecrire`)
- Fonction `generer_lien_entite` (utiliser `generer_objet_lien`)
- Fonction `generer_introduction_entite` (utiliser `generer_objet_introduction`)
- Fonction `generer_info_entite` (utiliser `generer_objet_info`)
- Fonction `lignes_longues` (utiliser un style CSS tel que `word-wrap:break-word;`)
- Fonction `extraire_date`
- Fonction `exporter_csv_ligne` (utiliser `exporter_csv_ligne_numerotee`)
- Fonctions `cvtmulti_formulaire_charger` et  `cvtmulti_formulaire_verifier` (voir `cvtmulti_formulaire_charger_etapes` et `cvtmulti_formulaire_verifier_etapes`)
- Fonction `auteurs_article` (utiliser `auteurs_objets`)
- Fonction `param_low_sec` (utiliser `generer_url_api_low_sec`)
- Fonction `spip_connect_ldap` (utiliser `auth_ldap_connect`)
- Fonction `_nano_sha256` (utiliser `hash('sha256', $str)`)
- #5505 Fonctions `verif_butineur()`, `editer_texte_recolle()` et environnement `_texte_trop_long` des formulaires (Inutilisé — servait pour IE !)
- #5258 Retrait de toute mention à GD1 dans la configuration des vignettes
