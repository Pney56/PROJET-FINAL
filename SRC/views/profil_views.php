<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/css/style.css">
    <script src="Public/script/script.js" defer></script>
    <title>RAIBURARI - Profil</title>
</head>

<body>

    <?php require_once __dir__ . '/header.php'; ?>

    <main class="container">
        <section class="profil-section">
            <div class="profil-image">
                <img src="Public/image/image-fixe.jpg" alt="Mon image de profil">
            </div>
            <div class="profil-info">
                <h1> <?php  echo $_SESSION['username'] ?> </h1>
                <p><?php echo "Mon adresse email : " . $_SESSION['email'] ?></p>
                <a href="/PROJET-FINAL/change_profil" class="profil-modifier">Modifier profil</a>
            </div>
        </section>
            <!-- -------------------------manga favori------------------------------ -->
            <section id="highlighted-manga">
                <h2>Mangas favoris</h2>
                <?php
                // Afficher les mangas favoris
                echo $htmlFavoriMangas;
            ?>
            </section>
            <!-- ------------------------------------------------------------------- -->
    </main>


    <?php require_once __dir__ . '/footer.php'; ?>

</body>

</html>