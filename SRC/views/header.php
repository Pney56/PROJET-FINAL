<?php
// Démarrez la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Affiche le message d'erreur s'il existe dans la session
if (isset($_SESSION['error_message'])) {
    echo "<script>alert('{$_SESSION['error_message']}');</script>";
    // Effacer le message d'erreur de la session après l'affichage
    unset($_SESSION['error_message']);
}
?>

<header>
    <div id="logo">
        <a href="accueil"><img src="Public/image/logo.png" alt="Logo"></a>
    </div>

    <div class="main-nav">
        <ul>
            <li><a href="?route=mise_en_avant">Mise en avant</a></li>
            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>
                <li><a href="?route=admin_mise_en_avant">Gestion Mise en avant</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="search-container">
        <form action="?route=<?php echo $_GET['route'] ?? 'accueil'; ?>" method="GET" id="search-form">
            <input type="text" name="query" id="search" placeholder="Entrez le nom d'un manga...">
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <?php if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']): ?>
        <div id="profile">
            <a href="?route=profil">Mon profil</a>
            <form action="?route=logout" method="post">
                <button class="logout-button" type="submit">Déconnexion</button>
            </form>
        </div>
    <?php else: ?>
        <button id="login-btn">Connexion</button>
    <?php endif; ?>
</header>


<div id="login-container">
    <button id="close-login-btn">&times;</button>

    <?php
    // Affiche le message d'erreur s'il existe
    if (isset($errorMessage)) {
        echo "<p class=\"error-message\">$errorMessage</p>";
    }
    ?>

    <div class="formulaire">
        <h1 class="titre-form">RABURARI</h1>
        <form class="sign-in" action="index.php?route=login" method="post">
            <label for="email">Adresse email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Connexion</button>
        </form>

        <form class="sign-up" id="signup-form" action="index.php?route=register" method="post">
            <a href="#" id="back-to-login-link">Retour à la connexion</a>
            <h2>Inscription</h2>
            <label for="sign-up-username"> Nom d'utilisateur:</label>
            <input type="text" id="sign-up-username" name="sign-up-username" required>
            <label for="sign-up-password"> Mot de passe:</label>
            <input type="password" id="sign-up-password" name="sign-up-password" required>
            <label for="sign-up-email"> Adresse email:</label>
            <input type="email" id="sign-up-email" name="sign-up-email" required>
            <input type="checkbox" id="accept-terms" name="accept-terms" required>
            <label for="accept-terms">J'accepte les conditions d'utilisation</label>
            <button type="submit">Inscription</button>
        </form>

        <a href="#" id="signup-btn">Pas de compte ? Inscris-toi !</a>
</div>
</div>
