<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/css/style.css">
    <script src="Public/script/script.js" defer></script>
    <title>RAIBURARI - Admin Mise en avant</title>
</head>

<body>

    <?php require_once __dir__ . '/header.php'; ?>

    <main class="container">
    <div class="profil-container">

    
        <!-- -------------------------manga favori------------------------------ -->
        <section id="highlighted-manga">
            <h2>Mangas favoris</h2>
            <?php                // Afficher les mangas favoris
            echo $htmlFavoriMangas;
            ?>
        </section>
        <!-- ------------------------------------------------------------------- -->
        </div>

    </main>


    <?php require_once __dir__ . '/footer.php'; ?>

</body>

</html>
