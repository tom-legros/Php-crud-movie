# SAÉ 2.01 - Développement d'une application

Application Web de consultation de données de films et d'acteurs

## Auteurs

- Tom Legros : tom.legros@etudiant.univ-reims.fr
- Theo Bordier : theo.bordier@etudiant.univ-reims.fr

## Fonctionnalités

L'application propose actuellement les pages suivantes :

- La page d'accueil ou il y a la liste des films (index.php)
- La page film ou il y a le détail du film avec son casting (movie.php)
- La page acteur ou il y a le détail d'un acteur avec sa filmographie (actor.php)

Chaque page film et acteur a un lien de retour vers l'accueil celle ou il ya la liste des films


## Installation / Configuration

### Récupération du projet

```bash
git clone https://iut-info.univ-reims.fr/gitlab/legr0178/sae2-01.git
cd sae2-01
composer install
```

### Configuration de la base de données

La connexion à la base de données est configurée via un fichier `.mypdo.ini` à placer à la racine

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