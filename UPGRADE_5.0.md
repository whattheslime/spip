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
