<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/css/style.css">
    <script src="Public/script/script.js" defer></script>
    <title>Mise en avant des mangas</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <h1 class="text-center">Mise en avant des mangas</h1>
        <?php if (!empty($results)) : ?>
            <p class="text-center">Manga mis en avant :</p>
            <?php include 'manga_views.php'; ?>
        <?php else : ?>
            <p class="text-center">Aucun manga mis en avant pour le moment.</p>
        <?php endif; ?>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>
