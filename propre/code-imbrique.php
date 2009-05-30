<?php

	$test = 'Ne pas crasher sur les <code><code></code> imbriqués';
	require '../test.inc';

	include_spip('inc/texte');

	$c = dutexte();


	propre($c);

	die('OK');


	//
	// DONNEES
	//

	function dutexte() {
		return '({{{Classificar els resultats}}}

<html><tt><b>{par</b> <i>critère_de_classement</i><b>}</b></tt></html> iIndica l’ordre en què es presenten els resultats. Aquest criteri de classificació correspon a una de les etiquetes extretes de la base de dades per cada tipus de bucle. Per exemple, podrem classificar els articles per la data <code>{per date}</code>, per la data en què han estat redactats  <code>{par date_redac}</code> o per títol <code>{par titre}</code>. (Fixeu-vos que, tot i que les etiquetes es presenten en majúscules, els criteris de classificació es presenten en minúscules.)

{Cas particular}: {{<code>{par hasard}</code>}} (per atzar) permet mostrar una llista presentada en ordre aleatori.

{Invertir la classificació}. A més a més, {{<code>{inverse}</code>}} provoca la presentació d’una classificació en ordre invers. Per exemple <code>{par date}</code> comença pels articles més antics;  amb <code>{par date}{inverse}</code> la llista es comença amb els articles més recents.

A partir d\'[->3369], el criteri {inverse} pot agafar com a paràmetre qualsevol marcador per tal de variar dinàmicament el sentit de la tria. Per exemple, és possible escriure: <code><BOUCLE_exemple(ARTICLES){par #ENV{tri}}{inverse #ENV{senstri}}></code>, la qual cosa permet escollir la columna de selecció i el sentit del que s\'escull per mitjà del url (&senstri=1 o &senstri=0)

{Classificar per número}. <span style=\'color: red;\'>[SPIP 1.3]</span>  Quan el criteri de  classificació es un element de text (per exemple el títol –{titre}-), la classificació es fa per ordre {alfabètic}. No obstant, per forçar un ordre de presentació, es pot posar un número al davant del títol. Per exemple: «1. El meu primer article», « 2. Segon article», « 3. Tercer... », etc. Amb una classificació alfabètica, la classificació d’aquests elements donaria la sèrie «1, 10, 11, 2, 3...». Per restablir la classificació numèrica, es pot fer servir el criteri:

<html><tt><b>{par num</b> critère<b>}</b></tt></html>

Per exemple: 

<cadre><BOUCLE_articles(ARTICLES){id_rubrique}{par date}{inverse}></cadre>

mostra els articles d’una secció classificats segons un ordre cronològic invers (els més recents al començament, els més antics al final), i: 

<cadre><BOUCLE_articles(ARTICLES){id_rubrique}{par titre}>
</cadre>

els mostra segons l’ordre alfabètic del seu títol;  finalment:

<cadre><BOUCLE_articles(ARTICLES){id_rubrique}{par num titre}>
</cadre>

els mostra segons l’ordre del número del seu títol. (ALERTA: l\'opció <code>{par num titre<code>}</code> no funciona en les versions de MySQL anteriors a la versió 3.23).

{Classificar segons diversos criteris} A partir de  [->3005], es pot classificar segons diversos criteris: <html><tt><b>{par</b> critère1<b>,</b> critère2<b>}</b></tt></html>. S\'indiquen d\'aquesta manera ordres de classificació consecutives. Els resultats es s\'ordenaran primerament segons el {critère1}, després el {critère2} pels resultats que tinguin el mateix {critère1}. Es poden especificar tants criteris com sigui necessari.

Per exemple <code>{par date, titre}</code> ordena els resultats per {date} després els resultats que tenen la mateixa {date} seran ordenats per {titre}.

Amb [->3176] podem especificar diversos criteris <html><tt><b>{par</b> <i>...</i><b>}</b></tt></html> per un boucle per arribar al mateix resultat. Per exemple: <code>{par date} {par titre}</code> és equivalent a l\'exemple anterior.

<blockquote>
{Comentari:} Quan s\'utilitzen diversos criteris de classificació, el criteri <HTML><TT><B>{inverse}</B></TT></HTML> només s\'aplica al criteri de classificació situat just abans. 

És per això que [->3176] introdueix la notació <HTML><TT><B>{!par ...}</B></TT></HTML> que inversa un criteri de classificació en particular. Per exemple: <code>{!par date} {par num titre}</code> classifica per {date} decreixents, després per números creixents en el mateix {titre} pels resultats que tenen la mateixa {date}.
</blockquote>


{{{Comparacions, igualtats}}}

<HTML><TT><B>{</B><I>critère</I> <B> < </B><I>valeur</I><B>}</B></TT></HTML> Comparació amb un valor fixat (es pot utilitzar «>», «<», «=», «>=», «<=». Tots els {criteris de classificació} (tal i com són extrets de la base de dades) poden ser utilitzats igualment per limitar el número de resultats. 

El valor a la dreta de l\'operador pot ser:

- Un valor constant fixat a l\'esquelet. Per exemple:

<cadre><BOUCLE_art(ARTICLES){id_article=5}></cadre>
mostra només l’article que té el número 5. És útil, per exemple, per ressaltar un article concret a la pàgina d’inici.

<cadre><BOUCLE_art(ARTICLES){id_secteur=2}></cadre>
mostra els articles del sector número 2. 

- A partir de <span style=\'color: #fa9a00;\'>[SPIP 1.8]</span>, una etiqueta disponible en el context del bucle. Per exemple:

<cadre>
<BOUCLE_art(ARTICLES){id_article=5}>
<BOUCLE_titre(ARTICLES) {titre=#TITRE}>
...
</BOUCLE_titre>
</BOUCLE_art>
</cadre>
serveix per trobar els articles que tenen el mateix títol que l\'article 5.

<blockquote>
{Atenció:} Només podem fer servir una etiqueta simple. No està permès ni filtrar-la ni posar-hi codi opcional.

En especial, si volem utilitzar l\'etiqueta {{#ENV}} -- o una altra etiqueta que admeti paràmetres --, hem d\'emprar la notació: <code>{titre = #ENV{titre}}</code> i {{no}}: <code>{titre = [(#ENV{titre})]}</code>.
</blockquote>

{{Expressions regulars:}} 

Molt potent (però força més complexe de manipular), el terme de comparació « == » introdueix una comparació segons una expressió regular. Per exemple:

<cadre><BOUCLE_art(ARTICLES){titre==^[aA]}></cadre>
selecciona els articles el títol dels quals comença per « a » o « A ».

{{Negació:}}

A partir de <span style=\'color: red;\'>[SPIP 1.2]</span> es pot fer servir la notació <html><tt>{xxx != yyy}</tt> i <tt>{xxx !== yyy}</tt></html>, el <html>!</html> corresponent a la negació (operador lògic NOT). 

<cadre><BOUCLE_art(ARTICLES){id_secteur != 2}></cadre>
selecciona els articles que no pertanyen al sector número 2.

<cadre><BOUCLE_art(ARTICLES){titre!==^[aA]}></cadre>
selecciona els articles el títol dels quals {no} comença per « a » o « A ». 

{{{Publicació en funció de la data}}}

Per facilitar l\'ús de les comparacions a les dates, s\'han afegit els criteris següents: 
- <TT>age</TT> i <TT>age_redac</TT> corresponen respectivament a l’antiguitat de la publicació i de la primera publicació d’un article, en dies: <TT><code>{</code>age<30<code>}</code></TT> selecciona els elements publicats des de fa menys d’un mes;
- els critères <TT>mois</TT>, <TT>mois_redac</TT>, <TT>annee</TT>, <TT>annee_redac</TT> permeten comparar amb valors fixes (per exemple, <code>{annee<=2000}</code> pels elements publicats fins l’any 2000).

Es poden combinar diversos criteris per efectuar seleccions més precises. Per exemple: 

<cadre><BOUCLE_art(ARTICLES){id_secteur=2}{id_rubrique!=3}{age<30}></cadre>
mostra els articles del sector 2, excepte els de la secció 3, i publicats des de fa menys de 30 dies. 

{Una astúcia}. El criteri <code>edat</code> és molt pràctic per mostrar els articles o les breus la data dels quals és « posterior » a l’actual, amb valors negatius (a condició d’haver seleccionat, a la Configuració precisa del lloc, la opció « Publicar els articles amb data posterior »). Per exemple, aquest criteri permet de donar èmfasi a futurs esdeveniments: <code>{age<0}</code> selecciona els articles o les breus d’una data posterior (« desprès » d’avui)... 

<span style=\'color: red;\'>(SPIP 1.3)</span> {Edat respecte a una data donada}. El criteri edat <code>(age)</code> es calcula en relació a la data d’avui (d’aquesta manera, <code>{age<30}</code> correspon als articles publicats des de fa menys d’un mes respecte a la data d’avui). El criteri <tt><b>age_relatif</b></tt> (edat relativa) compara la data d’un article o d’una breu amb una data «actual»; per exemple, a l’interior d’un bucle ARTICLES, coneixem ja una data per a cada resultat del bucle, per tant, podem seleccionar en relació a aquesta data (i no només en relació amb la data d’avui). 

Per exemple: 
<cadre>
<BOUCLE_article_principal(ARTICLES){id_article}>

	<h1>#TITRE</h1>

<BOUCLE_suivant(ARTICLES){id_rubrique}{age_relatif<=0}{exclus}{par date}{0,1}>
	Article següent: #TITRE
	</BOUCLE_suivant>

</BOUCLE_article_principal>
</cadre>

el BOUCLE_suivant mostra un únic article de la mateixa secció, classificat per data, la data de publicació del qual és inferior o igual a la data de l’« article_principal »; és a dir, l’article de la mateixa secció publicat després de l’article principal.

Trobareu informació més àmplia sobre la utilització de les dates a l\'article  que parla sobre «[->2198]».
 
{{{Presentació d’una part dels resultats}}}

- {{<code>{branche}</code>}} A partir de <span style=\'color: #066;\'>[SPIP 1.8.2]</span>, limita els resultats -- pels bucles que tenen un #ID_RUBRIQUE -- a la branca actual (la secció actual i les subseccions). Per exemple:
_ <code><BOUCLE_articles(ARTICLES) {branche}></code> ens tornarà tots els articles de la secció actual i de les seves subseccions,
_ <code><BOUCLE_articles(ARTICLES) {!branche}></code> ens tornarà tots els articles uq no es troben dins de la secció actual o les seves subseccions,

Es pot utilitzar el criteri 
<HTML><TT><B>{branche?}</B></TT></HTML> {optionnel} per aplicar-lo només si una secció es selecciona dins del context (un bucle englobant o l\'url proporcionada per un id_rubrique). Per exemple:
_ <code><BOUCLE_articles(ARTICLES) {branche?}></code> ens retornarà tots els articles de la secció actual i de les seves subseccions si hi ha un id_rubrique en el context, sinó, ens torna tots els articles del lloc Web.

[#doublons<-]
- {{<code>{doublons}</code>}} o {{<code>{unique}</code>}} (aquests dos criteris són absolutament idèntics) permeten prohibit que es mostrin resultats que ja s\'han mostrar dins d\'altres bucles utilitzant aquest criteri.

<quote>{històric:}
A partir de <span style=\'color: red;\'>[SPIP 1.2]</span> i fins a [<span style=\'color: red;\'>S</span><span style=\'color: orange;\'>P</span><span style=\'color: yellow;\'>I</span><span style=\'color: green;\'>P </span><span style=\'color: blue;\'>1</span><span style=\'color: black;\'>.</span><span style=\'color: darkviolet;\'>7</span>.2], només els bucles {{<tt>ARTICLES, RUBRIQUES, DOCUMENTS</tt>}} i {{<tt>SITES</tt>}} acceptaven aquest criteri.</quote>

[#doublons_nomme<-]
- {{<code>{doublons</code>}} {<code>xxxx</code>}{{<code>}</code>}} a partir de <span style=\'color: #fa9a00;\'>[SPIP 1.8]</span>, es poden tenir diversos criteris <code>{doublons}</code> independents. Els bucles que tinguin <code>{doublons rouge}</code> no tindran cap incidència sobre els bucles que tinguin <code>{doublons bleu}</code> com a criteri.

[#exclus<-]
- {{<code>{exclus}</code>}} permet excloure del resultat l\'element (article, breu, secció, etc.) en el qual ja ens trobem. Per exemple, quan publiquem els articles continguts en una mateixa secció, no volem publicar un enllaç cap a l\'article en el que ja ens trobem.

[#critere_in<-]
- <HTML><TT><B>{</B><I>xxxx</I><B> IN </B><I>a,b,c,d,...</I><B>}</B></TT></HTML> a partir de <span style=\'color: #fa9a00;\'>[SPIP 1.8]</span>, limita la presentació als resultats que tinguin el criteri {xxxx} igual a {a, b, c} {{o}} {d.} Els resultats són ordenats segons l\'ordre indicat (excepte per demanda explícita d\'un altre criteri d\'ordre). També és possible seleccionar cadenes de caràcters, per exemple amb <code>{titre IN \'Chine\', \'Japon\'}</code>.

Amb 
[->3369],  les etiquetes són reconegudes en els arguments d\'IN, i sobretot l\'etiqueta <TT>ENV</TT>, a la que se li apliquen els filtres d\'anàlisi per assegurar que l\'ordre SQL s\'escriurà bé. De forma derogatòria, Spip verificarà si l\'argument d\' <TT>ENV</TT> apunta cap a una taula (venint per exemple d\'entrades de formulari l\'atribut de les quals <tt>name</tt> s\'acaba per <tt>[]</tt>). Si aquest és el cas, i si els filtres d\'anàlisi han estat desactivats sufixant aquesta etiqueta per una doble estrella, llavors cada element de la taula serà considerat com argument d\'IN, aplicant Spip els filtres de seguretat damunt de cadascun d\'ells.

L\'esquelet estàndard <tt>formulaire_forum_previsu</tt> subministra un exemple d\'ús amb un bucle MOTS que té el criteri <HTML><tt>{id_mot IN #ENV**{ajouter_mot}}</tt></HTML>: aquest bucle selecciona només les paraules clau que pertanyen a un conjunt indicat dinàmicament. Aquí, aquest conjunt haurà estat construit pel formulari de l\'esquelet estàndard <tt>choix_mots</tt>, el qual utilitza atributs <tt>name=ajouter_mot[]</tt>.

- <HTML><TT><B>{</B><I>a</I><B>,</B><I>b</I><B>}</B></TT></HTML> on {a} i {b} són xifres. Aquest criteri permet limitar el número de resultats. {a} indica el resultat a partir del qual es comença la visualització (atenció, el primer resultat porta el número 0 - zero) ; {b} indica el número de resultats mostrats. 

Per exemple <HTML><TT>{0,10}</TT></HTML> mostra els deu primers resultats; <HTML><TT>{4,2}</TT></HTML> mostra els dos resultats a partir del cinquè (inclòs). 

<HTML><TT><B>{debut_</B><I>xxx</I><B>,</B><I>b</I><B>}</B></TT></HTML> és una variant molt elaborada del criteri anterior. Permet fer començar la limitació dels resultats per una variable passada per l’URL (aquesta variable reemplaça així la {a} que se li indicava anteriorment). És un funcionament una mica complex, però afortunadament no es necessari fer-la servir gaire sovint.

La variable passada per l’URL comença forçosament per <TT>debut_xxx</TT> (on {xxx} és una paraula escollida pel webmestre). D’aquesta manera, per una pàgina que té com URL:

<HTML><TT>spip.php?page=petition&id_article=13&debut_signatures=200</TT></HTML>

amb un esquelet <TT>(petition.html)</TT> que conté, per exemple:

<cadre><BOUCLE_signatures(SIGNATURES){id_article}{debut_signatures,100}></cadre>

obtindrem la llista de 100 signatures a partir de la 201[[<recorda> el primer resultat té el número 0, per tant el resultat 200 representa realment la signatura número 201]]. Amb l’URL: 

<HTML><TT>spip.php?page=petition&id_article=13&debut_signatures=300</TT></HTML>

obtindríem la llista de 100 signatures a partir de la 301[[<recorda>]].

- <HTML><TT><B>{</B><I>a</I><B>,n-</B><I>b</I><B>}</B></TT></HTML> a partir de <span style=\'color: #fa9a00;\'>[SPIP 1.8]</span>, és una variant de <code>{a,b}</code> la que limita la publicació en funció del número de resultats dins el bucle. {a} és el resultat a partir del qual començar a fer la publicació; {b} indica el número de resultats a {{no mostrar}} al final del bucle.

<code>{0,n-10}</code> mostrarà tots els resultats del bucle excepte els 10 últims.

- <HTML><TT><B>{n-</B><I>a</I><B>,</B><I>b</I><B>}</B></TT></HTML> a partir de <span style=\'color: #fa9a00;\'>[SPIP 1.8]</span>, és el que penja de <code>{a, n-b}</code>. Es limita la publicació a {b} resultats després del {a}<sup>e</sup> resultat del bucle.  

Per exemple: <code>{n-20,10}</code> mostrarà 10 resultats partint del 20<sup>è</sup> resultat abans del final del bucle.

- <HTML><TT><B>{</B><I>a</I><B>/</B><I>b</I><B>}</B></TT></HTML> on {a} i {b} són xifres. Aquest criteri permet mostrar una part {a} (proporcionalment) dels resultats en relació al nombre total «porcions» {b}. 

Per exemple: <HTML><TT>{1/3}</TT></HTML> mostra el primer terç dels resultats. Aquest criteri és útil, sobretot, per presentar llistes en diverses columnes. Per obtenir una visualització en dues columnes, hem de crear un primer bucle, dins d’una cel·la d’una taula, amb el criteri <code>{1/2}</code> (la primera meitat dels resultats); després mostrarem un segon bucle dins una nova cel·la, amb el criteri <code>{2/2}</code> (la segona meitat dels resultats).

{Atenció}. La utilització del [criteri <code>{doublons}</code>->#doublons] amb aquest criteri és perillós. Per exemple: 

<cadre>
<BOUCLE_prem(ARTICLES){id_rubrique}{1/2}{doublons}>
	<li> #TITRE
</BOUCLE_prem>
<BOUCLE_deux(ARTICLES){id_rubrique}{2/2}{doublons}>
	<li> #TITRE
</BOUCLE_deux>
</cadre>

no mostrarà tots els articles de la secció! Imaginem, per exemple, que hi ha un total de 20 articles a la nostra secció. El BOUCLE_prem mostrarà la primera meitat dels articles, és a dir els 10 primers, i impedirà (com a conseqüència de <tt><code>{doublons}</code></tt>) de tornar-los a utilitzar. El BOUCLE_deux, per la seva part, recuperarà la segona meitat dels articles d’aquesta secció {que encara no s’han mostrat} pel BOUCLE_prem; o sigui, la meitat dels 10 articles següents, és a dir els 5 últims articles de la secció. Haurem « perdut », per tant, 5 articles en aquesta operació... 

{{{Visualització {entre} els resultats}}}

<tt>{{<code>{</code>}}"{inter}"{{<code>}</code>}}</tt> permet indicar un codi HTML (aquí, {inter}) inserit {entre} els resultats del bucle. Per exemple, per separar una llista d’autors per una coma, ho farem de la manera següent: 
<cadre><BOUCLE_auteurs(AUTEURS){id_article}{","}></cadre>

{{{Divers}}}

{{<code>{logo}</code>}} permet seleccionar només els articles (o seccions, etc) que disposin d\'un logo. Funciona també en el bucle (HIERARCHIE). El criteri invers <code>{!logo}</code> llista els objectes que no tenen logo.';
}


?>
