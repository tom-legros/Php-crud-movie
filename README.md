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