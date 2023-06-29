# UPGRADE de SPIP 4.2 à 5.0

## Préliminaires

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


# Suppressions des dépréciations

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
