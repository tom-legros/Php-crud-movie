# SAÉ 2.01 - Développement d'une application

Application Web de consultation de données de films et d'acteurs, réalisée dans le cadre du BUT Informatique à l'IUT de Reims.

## Auteurs

- Tom Legros : tom.legros@etudiant.univ-reims.fr
- Theo Bordier : theo.bordier@etudiant.univ-reims.fr

## Fonctionnalités

L'application propose actuellement les pages et fonctionnalités suivantes :

- La page d'accueil avec la liste des films, avec filtrage par genre (index.php)
- La page film avec le détail du film et son casting (movie.php)
- La page acteur avec le détail d'un acteur et sa filmographie (actor.php)

Chaque page film et acteur dispose d'un lien de retour vers l'accueil.

### En cours de développement

- Création, édition et suppression d'un film : les boutons/formulaires sont présents dans l'interface mais ces actions ne sont pas encore fonctionnelles.

## Installation / Configuration

### Récupération du projet

```bash
git clone https://github.com/tom-legros/Php-crud-movie.git
cd Php-crud-movie
composer install
```

> **Note :** ce projet a été développé dans le cadre d'une SAÉ à l'IUT de Reims. La base de données utilisée est hébergée sur le serveur MySQL du département informatique, accessible uniquement depuis le réseau de l'IUT (intranet ou VPN). Pour exécuter ce projet en dehors de ce contexte, il est nécessaire de fournir sa propre base MySQL avec un schéma compatible et d'adapter le fichier `.mypdo.ini` en conséquence.

### Configuration de la base de données

La connexion à la base de données est configurée via un fichier `.mypdo.ini` à placer à la racine.

Créer le fichier `.mypdo.ini` :

```ini
[mypdo]
dsn = "mysql:host=legr0178;dbname=legr0178_movie;charset=utf8"
username = login
password = mdp
```

### Serveur Web local

Lancer le serveur Web local PHP à la racine du projet grâce à Composer :

Sur Linux :

```bash
composer start:linux
```

Sur Windows :

```bash
composer start:windows
```

Le serveur est accessible sur `http://localhost:8000`

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
