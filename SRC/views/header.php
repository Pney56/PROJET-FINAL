<header>
    <div id="logo">
        <a href="accueil"><img src="Public/image/logo.png" alt="Logo"></a>
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="mise_en_avant">Mise en avant</a></li>
            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>
            <li><a href="admin_mise_en_avant">Gestion Mise en avant</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="search-container">
        <form action="/PROJET-FINAL/accueil" method="GET" id="search">
            <input type="text" name="query" id="search" placeholder="Entrez le nom d'un manga...">
            <button type="submit">Rechercher</button>
        </form>
    </div>
    <?php if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']): ?>
    <div id="profile">
        <a href="?route=profil">Mon profil</a>
        <form action="?route=logout" method="post">
    <button class="logout-button" type="submit">Deconnexion</button>
</form>
    </div>
    <?php else: ?>
    <button id="login-btn">Connexion</button>
    <?php endif; ?>
</header>


<div id="login-container">
    <button id="close-login-btn">&times;</button>
    
    <?php
        //  Affiche le message d'erreur s'il existe
        if (isset($errorMessage)) { 
            echo "<p class=\"error-message\">$errorMessage</p>";
        }
        ?>
    <main class="formulaire">
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
            <label for="sign-up-username">Nom d'utilisateur:</label>
            <input type="text" id="signup-username" name="signup-username" required>
            <label for="sign-up-password">Mot de passe:</label>
            <input type="password" id="signup-password" name="signup-password" required>
            <label for="sign-up-email">Adresse email:</label>
            <input type="email" id="signup-email" name="signup-email" required>
            <input type="checkbox" id="accept-terms" name="accept-terms" required>
            <label for="accept-terms">J'accepte les conditions d'utilisation</label>
            <button type="submit">Inscription</button>
        </form>

        <a href="#" id="signup-btn">Pas de compte ? Inscris-toi !</a>
    </main>
</div>
