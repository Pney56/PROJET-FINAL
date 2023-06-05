# PROJET-FINAL-RAIBURARI

Projet final Kercode - Raiburari est un projet de site web qui facilite la recherche et la gestion des favoris pour les fans de manga. Il utilise l'API MyListAnime pour accéder à des informations détaillées sur les mangas et permet aux utilisateurs de les ajouter à leur liste de favoris pour les retrouver facilement.

## Fonctionnalités

- Recherche de manga via l'API MyListAnime
- Affichage des détails du manga (titre, auteur, synopsis, etc.)
- Ajout de mangas aux favoris pour un accès rapide et simple
- Architecture MVC (Modèle-Vue-Contrôleur) pour une organisation claire du code
- Utilisation de dotenv pour la gestion des variables d'environnement

## Langages utilisés

- PHP
- JavaScript
- HTML
- CSS

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés :

- [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
- [Dotenv](https://github.com/vlucas/phpdotenv#installation)

## Obtenir une clé API MyListAnime

Pour utiliser l'API MyListAnime, vous devez d'abord créer un compte sur leur site :

1. Allez sur MyListAnime et créez un compte
2. Connectez-vous à votre compte
3. Accédez à la section "API" ou "Développeurs" pour générer une clé API
4. Copiez la clé API pour l'utiliser dans votre projet Raiburari

## Installation

1. Clonez ce dépôt sur votre machine locale en utilisant la commande `git clone https://github.com/[votre-nom-utilisateur]/raiburari.git`
2. Accédez au dossier du projet avec `cd raiburari`
3. Installez les dépendances en exécutant `composer install`
4. Installez les dépendances npm en exécutant `npm install`
5. Créez un fichier .env à la racine du projet pour y stocker vos variables d'environnement (par exemple, l'URL de l'API MyListAnime et votre clé API)
6. Lancez le serveur de développement avec `npm start`
7. Le site devrait maintenant être accessible à l'adresse http://localhost:3000.

## Utilisation de Composer et Dotenv

### Installation de Composer

1. Téléchargez et installez Composer en suivant les instructions officielles disponibles sur la page [Composer - Getting Started](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos).

### Installation de Dotenv

1. Ouvrez votre terminal.
2. Accédez au répertoire de votre projet où se trouve le fichier `composer.json`.
3. Exécutez la commande suivante pour installer Dotenv :


4. Après l'installation, vous pouvez utiliser Dotenv en l'incluant dans vos fichiers PHP :

```php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
