<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/css/style.css">
    <script src="Public/script/script.js" defer></script>
    <title>Bibliothèque de manga - Détails du manga</title>
    
</head>

<body>

    <?php require_once __dir__ . '/header.php'; ?>

    <main class="container">
        <section class="manga-details-container">
            <?php
                if (isset($mangaDetails)) {
                    $controller->displayMangaDetails($mangaDetails);
                } else {
                    echo "Token de L'api introuvable. ";
                }
            ?>
        </section>
    </main>


    <?php require_once __dir__ . '/footer.php'; ?>

</body>

</html>
