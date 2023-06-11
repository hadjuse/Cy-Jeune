<p align="center" width="100%">
    <img width="50%" src="image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png">
</p>

# Cy-Jeune 6.4
FORTIER Théo, RABEARIMANANA Hadj, MARTIN SOARES Flavio BENZOUA Zinedine
Le projet, adressé aux jeunes entre 16 et 30 ans, vise à valoriser toute expérience  comme source d’enrichissement qui puisse être reconnue comme l’expression d’un  savoir faire ou savoir être. 

## Sommaire:

1. **[Cas d'utilisation Xamp Server](#xamp)**
2. **[Cas d'utilisation Linux](#linux)**

# <a name="xamp"></a>Cas d'utilisation Xamp Server
Si vous utilisez xamp server, une modification dans le fichier ```javascript/admin.js``` est nécéssaire.
A la ligne 45, vous devez remplacer
```javascript
    var url = "../php/suppression.php?f=" + id_ref + "&u=" + id_utilisateur;
```
par
```javascript
    var url = "../Cy-Jeune/php/suppression.php?f=" + id_ref + "&u=" + id_utilisateur;
```
**On fait de même aux lignes 86 et 112**

# <a name="linux"></a>Cas d'utilisation Linux

L'exécution est normal il faudra juste taper dans le terminal
```php -S localhost:8080```
En revanche, lorsque vous recevez le mail de referent et que vous êtes sur linux:
il faut copier le lien allez sur un nouvel onglet:
et remplacer:
```http://localhost/Cy-Jeune/pagereferent.php?jeune=0&referent=10```
par
```http://localhost:8080/pagereferent.php?jeune=0&referent=10```
**Attention les valeurs dans les liens sont des exemples**
Il ne faut pas copier les lignes mais adapter à son code.
