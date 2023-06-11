# UPGRADE de SPIP 4.2 à 5.0

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
