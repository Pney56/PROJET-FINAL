<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/css/style.css">
    <script src="Public/script/script.js" defer></script>
    <title>RAIBURARI - accueil</title>

</head>

<body>

    <?php require_once __dir__ . '/header.php'; ?>

    <main class=" bg-image">
        <section id="highlighted-manga">
            <h2>MANGA</h2>
            <div>
                <?php
                // Afficher le contenu de $searchHtml contenant les résultats de recherche de mangas
                echo $searchHtml; 
                ?>
            </div>
        </section>
    </main>

    <?php require_once __dir__ . '/footer.php'; ?>

</body>

</html>
