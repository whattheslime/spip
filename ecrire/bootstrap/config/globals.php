<?php

/**
 * Globales (historiques) de config au démarrage de SPIP
 */

global
	$connect_id_rubrique,
	$connect_statut,
	$connect_toutes_rubriques,
	$controler_dates_rss,
	$cookie_prefix,
	$debut_date_publication,
	$derniere_modif_invalide,
	$dossier_squelettes,
	$exceptions_des_tables,
	$filtrer_javascript,
	$hash_recherche_strict,
	$hash_recherche,
	$help_server,
	$home_server,
	$ignore_auth_http,
	$ignore_remote_user,
	$ip,
	$ldap_present,
	$liste_des_authentifications,
	$liste_des_etats,
	$liste_des_statuts,
	$meta,
	$mysql_rappel_connexion,
	$mysql_rappel_nom_base,
	$nombre_de_logs,
	$path_sig,
	$path_files,
	$plugins,
	$puce,
	$source_vignettes,
	$spip_matrice,
	$spip_pipeline,
	$spip_sql_version,
	$spip_version_affichee,
	$spip_version_base,
	$spip_version_branche,
	$spip_version_code,
	$surcharges,
	$table_date,
	$table_des_tables,
	$table_prefix,
	$table_primary,
	$table_titre,
	$tables_auxiliaires,
	$tables_jointures,
	$tables_principales,
	$taille_des_logs,
	$test_i18n,
	$tex_server,
	$traiter_math,
	$type_urls,
	$url_glossaire_externe,
	$visiteur_session,
	$xhtml,
	$xml_indent;

# comment on logge, defaut 4 tmp/spip.log de 100k, 0 ou 0 suppriment le log
$nombre_de_logs = 4;
$taille_des_logs = 100;

// Prefixe des tables dans la base de donnees
// (a modifier pour avoir plusieurs sites SPIP dans une seule base)
$table_prefix = 'spip';

// Prefixe des cookies
// (a modifier pour installer des sites SPIP dans des sous-repertoires)
$cookie_prefix = 'spip';

// Dossier des squelettes
// (a modifier si l'on veut passer rapidement d'un jeu de squelettes a un autre)
$dossier_squelettes = '';

// Pour le javascript, trois modes : parano (-1), prive (0), ok (1)
// parano le refuse partout, ok l'accepte partout
// le mode par defaut le signale en rouge dans l'espace prive
// Si < 1, les fichiers SVG sont traites s'ils emanent d'un redacteur
$filtrer_javascript = 0;
// PS: dans les forums, petitions, flux syndiques... c'est *toujours* securise

// Type d'URLs
// inc/utils.php sélectionne le type 'page' (spip.php?article123) en l'absence
// d'autre configuration stockée en $GLOBALS['meta']['type_urls]
// Pour les autres types: voir urls_etendues
// $type_urls n'a plus de valeur par défaut en 3.1 mais permet de forcer une
// configuration d'urls dans les fichiers d'options.

#la premiere date dans le menu deroulant de date de publication
# null: automatiquement (affiche les 8 dernieres annees)
# 0: affiche un input libre
# 1997: le menu commence a 1997 jusqu'a annee en cours
$debut_date_publication = null;

// Pour renforcer la privacy, recopiez-la ligne
// dans le fichier config/mes_options): SPIP ne pourra alors conserver aucun
// numero IP, ni temporairement lors des visites (pour gerer les statistiques
// ou dans spip.log), ni dans les forums (responsabilite)
# $ip = substr(md5($ip),0,16);

// faut-il faire des connexions Mysql rappelant le nom de la base MySQL ?
// (utile si vos squelettes appellent d'autres bases MySQL)
// (A desactiver en cas de soucis de connexion chez certains hebergeurs)
// Note: un test a l'installation peut aussi avoir desactive
// $mysql_rappel_nom_base directement dans le fichier inc_connect
$mysql_rappel_nom_base = true;

// faut-il afficher en rouge les chaines non traduites ?
$test_i18n = false;

// faut-il ignorer l'authentification par auth http/remote_user ?
$ignore_auth_http = false;
$ignore_remote_user = true; # methode obsolete et risquee

// Invalider les caches a chaque modification du contenu ?
// Si votre site a des problemes de performance face a une charge tres elevee,
// vous pouvez mettre cette globale a false (dans mes_options).
$derniere_modif_invalide = true;

//
// Serveurs externes
//
# Serveur de documentation officielle
$home_server = 'https://www.spip.net';
# glossaire pour raccourci [?X]. Aussi: [?X#G] et definir glossaire_G
$url_glossaire_externe = 'https://@lang@.wikipedia.org/wiki/%s';

# TeX
$tex_server = 'https://math.spip.org/tex.php';
# MathML (pas pour l'instant: manque un bon convertisseur)
// $mathml_server = 'http://arno.rezo.net/tex2mathml/latex.php';

// Produire du TeX ou du MathML ?
$traiter_math = 'tex';

// Appliquer un indenteur XHTML aux espaces public et/ou prive ?
$xhtml = false;
$xml_indent = false;

// Controler les dates des item dans les flux RSS ?
$controler_dates_rss = true;

//
// Pipelines & plugins
//
# les pipeline standards (traitements derivables aka points d'entree)
# ils seront compiles par la suite
# note: un pipeline non reference se compile aussi, mais uniquement
# lorsqu'il est rencontre
// https://programmer.spip.net/-Les-pipelines-
$spip_pipeline = [];

# la matrice standard (fichiers definissant les fonctions a inclure)
$spip_matrice = [];
# les plugins a activer
$plugins = [];  // voir le contenu du repertoire /plugins/
# les surcharges de include_spip()
$surcharges = []; // format 'inc_truc' => '/plugins/chose/inc_truc2.php'

// Variables du compilateur de squelettes

$exceptions_des_tables = [];
$tables_principales = [];
$table_des_tables = [];
$tables_auxiliaires = [];
$table_primary = [];
$table_date = [];
$table_titre = [];
$tables_jointures = [];

// Liste des statuts.
$liste_des_statuts = [
	'info_administrateurs' => '0minirezo',
	'info_redacteurs' => '1comite',
	'info_visiteurs' => '6forum',
	'texte_statut_poubelle' => '5poubelle'
];

$liste_des_etats = [
	'texte_statut_en_cours_redaction' => 'prepa',
	'texte_statut_propose_evaluation' => 'prop',
	'texte_statut_publie' => 'publie',
	'texte_statut_poubelle' => 'poubelle',
	'texte_statut_refuse' => 'refuse'
];

// liste des methodes d'authentifications
$liste_des_authentifications = [
	'spip' => 'spip',
	'ldap' => 'ldap'
];

// Experimental : pour supprimer systematiquement l'affichage des numeros
// de classement des titres, recopier la ligne suivante dans mes_options :
# $table_des_traitements['TITRE'][]= 'typo(supprimer_numero(%s), "TYPO", $connect)';

// ** Securite **
$visiteur_session = $connect_statut = $connect_toutes_rubriques = $hash_recherche = $hash_recherche_strict = $ldap_present = '';
$meta = $connect_id_rubrique = [];

// version de l'interface a la base
$spip_sql_version = 1;
