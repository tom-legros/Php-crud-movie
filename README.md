# SAÉ 2.01 - Développement d’une application

## Auteur

- Tom Legros : tom.legros@etudiant.univ-reims.fr
- Theo Bordier : theo.bordier@etudiant.univ-reims.fr

## Installation / Configuration
## Serveur Web local

Lancer le serveur Web local PHP à la racine du projet grâce à composer :

```bash
composer start:linux
```
## Configuration de la base de données

La connexion à la base de données est configurée via un fichier .mypdo.ini à placer à la racine du projet.

Créer le fichier .mypdo.ini:

```ini
[mypdo]
dsn = "mysql:host=legr0178;dbname=legr0178_movie;charset=utf8"
username = login
password = mdp
```
## Style de codage

Le projet utilise PHP CS Fixer avec la recommandation PSR-12.

Vérifier le style de codage :

```bash
composer test:cs
```

Afficher les différences des corrections proposées :

```bash
php vendor/bin/php-cs-fixer fix --dry-run --diff
```

Appliquer automatiquement les corrections :

```bash
composer fix:cs
```