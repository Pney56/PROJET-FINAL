<?php

if (!isset($_SESSION)) {
    session_start();
}
require 'vendor/autoload.php';


use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Charger le contrôleur et les modèles
require_once 'SRC/controllers/UserController.php';
require_once 'SRC/controllers/ApiController.php';
require_once 'SRC/controllers/AccueilController.php';
require_once 'SRC/controllers/MangaController.php';
require_once 'SRC/controllers/MangaDetailsController.php';
require_once 'SRC/controllers/ProfilController.php';
require_once 'SRC/controllers/ProfilEditController.php';
require_once 'SRC/controllers/LogoutController.php';
require_once 'SRC/controllers/FavoriController.php';
require_once 'SRC/controllers/MiseEnAvantController.php';
require_once 'SRC/controllers/ContactController.php';
require_once 'SRC/controllers/Security.php';


require_once 'SRC/models/UserModel.php';


// Initialiser les modèles
$userModel = new UserModel();



// Initialiser le contrôleur
$userController = new UserController();
$apiController = new ApiController();
$accueilController = new AccueilController();
$contactController = new ContactController();



if (isset($_GET['route'])) {
    $action = $_GET['route'];

    switch ($action) {


        case 'accueil':
        $query = $_GET['query'] ?? null;
        $accueilController->index($query);
    break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->login();
        } else {
            $userController->showLoginForm();
        }
    break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->register();
        } else {
            $userController->showLoginForm();
        }
    break;

    case 'redirectToApi':
        $apiController->redirectToApi();
    break;

    case 'apiCallback':
        $apiController->handleApiCallback();
    break;


        
    case 'manga_details':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if ($id) {
            $mangaDetailsController = new MangaDetailsController();
            $mangaDetailsController->index($id);
        } 
    break;
        
    case 'profil':
        $controller = new ProfileController();
        $controller->index();
    break;

    case 'change_profil':
        $controller = new ProfileEditController();
        $controller->index();
    break;

    case 'update_profile':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ProfileEditController();
            $controller->updateProfile();
        }
    break;
    

    case 'delete_profile':
        $controller = new ProfileEditController();
        $controller->deleteProfile();
    break;

    case 'logout':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new LogoutController();
            $controller->index();
        } else {
            // Rediriger l'utilisateur vers la page d'accueil ou une autre page appropriée
            header("Location: accueil");
            exit;
        }
    break;


    case 'addFavori':
        $mangaId = isset($_GET['id']) ? intval($_GET['id']) : null;
        if ($mangaId && isset($_SESSION['username'])) {
            $favoriController = new FavoriController();
            $favoriController->addFavori($_SESSION['username'], $mangaId);
            header("Location: index.php?route=profil"); // Rediriger vers la page de profil
            exit;
        } else {
            echo "Erreur : Manga ID ou utilisateur non connecté.";
        }
    break;

    case 'removeFavori':
        $mangaId = isset($_GET['id']) ? intval($_GET['id']) : null;
        if ($mangaId && isset($_SESSION['username'])) {
            $favoriController = new FavoriController();
            $favoriController->removeFavori($_SESSION['username'], $mangaId);
            header("Location: index.php?route=profil"); // Rediriger vers la page de profil
            exit;
        } else {
            echo "Erreur : Manga ID ou utilisateur non connecté.";
        }
    break;



    case 'mise_en_avant':
        $controller = new MiseEnAvantController();
        $controller->index();
    break;
    
    case 'admin_mise_en_avant':
        if (isset($_SESSION['username'])) {
            $isAdmin = $userModel->checkIfUserIsAdmin($_SESSION['username']);
            if ($isAdmin) {
                $controller = new MiseEnAvantController();
                $controller->adminIndex();
            } else {
                echo "Accès non autorisé.";
            }
        } else {
            echo "Veuillez vous connecter pour accéder à cette page.";
        }
    break;

    case 'contact':
        $contactController->index();
    break;

    case 'submit_contact_form':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactController->handleFormSubmission();
        }
    break;
    



    default:
    echo "Page not found.";
    break;

}} else {
    // Aucune action spécifiée, afficher la page d'accueil par défaut ou une page d'erreur
    $accueilController->index();
}
