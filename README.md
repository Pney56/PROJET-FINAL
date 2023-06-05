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

Pour installer et configurer le projet Raiburari, veuillez suivre les étapes ci-dessous :

1. Clonez ce dépôt sur votre machine locale en utilisant la commande suivante :
git clone https://github.com/[votre-nom-utilisateur]/raiburari.git

2. Installez Composer en suivant les instructions officielles disponibles sur la page [Composer - Getting Started](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos).

3. Installez Dotenv en utilisant la commande suivante :
composer require vlucas/phpdotenv

4. Installez le projet sur un serveur PHP configuré (tel que Apache ou Nginx) avec prise en charge de la base de données MySQL.

5. Créez une nouvelle base de données avec le nom de votre choix sur votre serveur MySQL.

6. Importez le dossier SQL fourni (dans un dossier nommé "sql") dans la base de données que vous avez créée.

7. Renommez le fichier `.env.example` à la racine du projet en `.env`.

8. Ouvrez le fichier `.env` et modifiez les valeurs des variables d'environnement suivantes selon votre configuration :
DB_HOST=adresse_de_votre_serveur_mysql
DB_NAME=nom_de_votre_base_de_donnees
DB_USER=nom_utilisateur_de_votre_base_de_donnees
DB_PASSWORD=mot_de_passe_de_votre_base_de_donnees


9. Ouvrez le fichier `config/config.php` et modifiez les informations de connexion à la base de données selon votre configuration :

define('CLIENT_ID', 'VOTRE CLEF API');
define('CLIENT_SECRET', 'VOTRE CLIENT SECRET ');
define('REDIRECT_URI', 'REDIRECT DU SITE');

10. Lancez votre serveur PHP et accédez au site à l'aide de l'URL appropriée (par exemple, http://localhost/raiburari).


Assurez-vous d'avoir un serveur PHP, Composer et MySQL correctement configurés avant de commencer l'installation.
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
