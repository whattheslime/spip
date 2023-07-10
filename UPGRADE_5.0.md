# UPGRADE de SPIP 4.2 à 5.0

## Préliminaires

SPIP 5.0 nécessite PHP 8.1 minimum.

### Migration BDD

SPIP 5.0 ne contient pas les mises à jour de BDD antérieures à SPIP 4.0.
Pour rappel, SPIP 4.x ne contient pas les mises à jour antérieures SPIP 2.0.

Dit autrement, il faut a minima partir d’un SPIP 3.2 (ou supérieur donc) pour que la migration en SPIP 5.0 de la base de données s’effectue correctement.
Pour des questions de compatibilité de SPIP 5.0 avec PHP 8.1 minimum, il est conseillé (mais pas obligatoire) de partir au moins d’un SPIP 4.1.

### Déplacement plugins-dist

Les plugins-dist (plugins fournis avec la distribution SPIP et toujours activés) sont maintenant installés via l’outil Composer (ou présents dans l’archive SPIP téléchargée).

Ils sont maintenant placés dans le répertoire `plugins-dist/spip/` avec leur préfixe comme nom de répertoire. Ils étaient auparavant directement à la racine de `plugins-dist/`.

En conséquence, et en fonction de votre méthode de migration vers SPIP 5.0,
il faudra supprimer les anciens `plugins-dist/` de SPIP 4.2 à la racine s’ils sont présents.

Ainsi, par exemple, le plugin Textwheel était auparavant dans `plugins-dist/textwheel` et se retrouve après mise à jour en SPIP 5.0 dans `plugins-dist/spip/tw` (où `tw` est le préfixe du plugin)

### Webmestres

La constante `_ID_WEBMESTRES` (dépréciée en SPIP 2.1) n’est plus utilisée et n’a plus d’effet.

Si vous déclariez cette constante (dans `config/mes_options.php` par exemple), il convient de l’enlever et de déclarer les autrices et auteurs webmestres en conséquence depuis l’interface privée de SPIP en tant que webmestre (ou via le champ `webmestre` de la table `spip_auteurs` directement dans la base de données).

## Squelettes

### Parties optionnelles des balises

Il devient possible d’utiliser des crochets dans les parties optionnelles des balises. Ainsi :
- `[avant] (#VAL{texte})]` écrit `avant] texte`
- `[(#VAL{texte}) [après]` écrit `texte [après`
- `[avant] (#VAL{texte}) [après]` écrit `avant] texte [après`

En conséquence, certaines écritures de squelettes deviennent comprises comme des parties optionnelles, lorsque `(#BALISE` est utilisé alors que la parenthèse ne désigne pas une partie optionnelle.

Ce cas peut se trouver par exemple dans des écriture pour du CSS. Il convient de lever l’ambiguité

#### Avant

```css
a[href] { background-image: url(#CHEMIN_IMAGE{img.svg}); }
```

#### Après

```css
a[href] { background-image: url\(#CHEMIN_IMAGE{img.svg}); }
```

ou

```css
a[href] { background-image: url("#CHEMIN_IMAGE{img.svg}"); }
```

# Nouvelles dépréciations

Les éléments suivants sont dépréciés et seront supprimés dans une future version.

## Syntaxes de squelettes


### Critère `{collecte}` (déprécié en 5.0)

Utiliser `{collate}`

#### Avant

```spip
<BOUCLE_a(ARTICLES) {par titre} {collecte utf8_spanish_ci} {"<br />"}>...
```

#### Après

```spip
<BOUCLE_a(ARTICLES) {par titre} {collate utf8_spanish_ci} {"<br />"}>...
```

### Critères `{fusion}` (déprécié en 5.0)

Utiliser `{groupby}`

#### Avant

```spip
<BOUCLE_extrait(ARTICLES){fusion id_rubrique}>...
```

#### Après

```spip
<BOUCLE_extrait(ARTICLES){groupby id_rubrique}>...
```

### Critères `{fusion_supprimer}` (déprécié en 5.0)

Utiliser `{groupby_supprimer}`

#### Avant

```spip
<BOUCLE_facette_annee(ARTICLES){id_mot=27}{fusion_supprimer}{fusion YEAR(date)}>
    [(#DATE|annee)]<br />
</BOUCLE_facette_annee>
```

#### Après

```spip
<BOUCLE_facette_annee(ARTICLES){id_mot=27}{groupby_supprimer}{groupby YEAR(date)}>
    [(#DATE|annee)]<br />
</BOUCLE_facette_annee>
```


## Fonctions PHP

Dans certains cas parfois utilisées en filtres de squelettes également.

### Fonctions `extraire_multi` et `extraire_idiome`

Le 3è paramètre `$options` déprécié si booléen.
Ce paramètre `$options` doit être un `array`.

#### Avant

```php
$multi = extraire_multi($texte, 'en', true);
$idiome = extraire_idiome($texte, 'en', true);
```

#### Après

```php
$multi = extraire_multi($texte, 'en', ['echappe_span' => true]);
$idiome = extraire_idiome($texte, 'en', ['echappe_span' => true]);
```

### Fonction `spip_setcookie`

La fonction `spip_setcookie()` reprend les arguments de la fonction php [`setcookie`](https://www.php.net/manual/fr/function.setcookie.php).

Les constantes `_COOKIE_SECURE` et `_COOKIE_SECURE_LIST` sont dépréciées au profit des options
`secure` (activée par défaut en HTTPS) et `httponly` de la fonction

#### Exemple

```php
spip_setcookie('mon_cookie', 'ma valeur', time() + 3600, httponly: true);
```

### Fonction `spip_sha256` (dépréciée en 5.0)

Utiliser la fonction native `hash`

#### Avant

```php
$hash = spip_sha256('mon contenu');
```

#### Après

```php
$hash = hash('sha256', 'mon contenu');
```


# Suppressions des éléments dépréciés

Les éléments suivants ont été supprimés et doivent être adaptés si ce n’est pas encore le cas.

## Syntaxes de squelettes

### Filtres de `#LOGO_` (dépréciés en 2.1)

Les syntaxes des `#LOGO_xx` avec de faux filtres `|left` `|right` `|center` `|bottom`, `|top`, `|lien` `|fichier` ne sont plus prises en compte.

#### Avant

```spip
- [(#LOGO_ARTICLE|#URL_ARTICLE)]
- [(#LOGO_ARTICLE|fichier)]
- [(#LOGO_ARTICLE|lien)]
- [(#LOGO_ARTICLE|left)]
```

#### Après

```spip
- [(#LOGO_ARTICLE{#URL_ARTICLE})]
- [(#LOGO_ARTICLE**)]
- [(#LOGO_ARTICLE*)]
- [(#LOGO_ARTICLE{left})]
```

Note: les positionnements `left`, `right`, `center`, `bottom`, `top` ajustent simplement une classe CSS.

### Filtre de `#FORMULAIRE_RECHERCHE|parametre` (déprécié en 2.1)

#### Avant

```spip
[(#FORMULAIRE_RECHERCHE|param)]
```

#### Après

```spip
[(#FORMULAIRE_RECHERCHE{param})]
```

### Balise `#EXPOSER` (déprécié en 1.8.2)

#### Avant

```spip
[(#EXPOSER|on,off)]
```

#### Après

```spip
[(#EXPOSE{on,off})]
```

### Balise `#EMBED_DOCUMENT` (déprécié en 2.0)

#### Avant

```spip
[(#EMBED_DOCUMENT|autostart=true)]
```

#### Après

```spip
[(#MODELE{emb, autostart=true})]
```

### Filtre `foreach`

Le filtre déprécié `foreach` est supprimé. Utiliser une boucle `DATA`.

#### Avant

```spip
[(#LISTE{a,b,c,d}|foreach)]
```

#### Après

```spip
<BOUCLE_liste(DATA){source tableau, #LISTE{a,b,c,d}}>
- #CLE => #VALEUR <br />
</BOUCLE_liste>
```


### Boucle `POUR`

La boucle `POUR` dépréciée est supprimée. Utiliser une boucle `DATA`.

#### Avant

```spip
<BOUCLE_liste(POUR){tableau #LISTE{un,deux,trois}}>
- #CLE : #VALEUR <br />
</BOUCLE_liste>
```

#### Après

```spip
<BOUCLE_liste(DATA){source tableau, #LISTE{un,deux,trois}}>
- #CLE : #VALEUR <br />
</BOUCLE_liste>
```


## Fonctions PHP

Dans certains cas parfois utilisées en filtres de squelettes également.

### Fonction `http_status`

La fonction dépréciée `http_status` est supprimée.
Utiliser la fonction PHP native `http_response_code`

#### Avant

```php
http_status(404);
```

#### Après

```php
http_response_code(404);
```


### Fonction `generer_url_ecrire_objet`

La fonction dépréciée `generer_url_ecrire_objet` est supprimée.
Utiliser `generer_objet_url_ecrire`.

#### Avant

```php
$url = generer_url_ecrire_objet(3, 'article');
```

```spip
[(#ID_ARTICLE|generer_url_ecrire_objet{article})]
```

### Après

```php
$url = generer_objet_url_ecrire(3, 'article');
```

```spip
[(#ID_ARTICLE|generer_objet_url_ecrire{article})]
```

### Fonctions `generer_{x}_entite`

De même que  `generer_url_ecrire_objet` les fonctions dépréciées

- `generer_lien_entite`
- `generer_introduction_entite`
- `generer_info_entite`

Sont supprimées et remplacées (renommées) par

- `generer_objet_lien`
- `generer_objet_introduction`
- `generer_objet_info`
