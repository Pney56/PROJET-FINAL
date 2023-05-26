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

    <main>
    <section class="manga-details-container">
        <div class="manga-info-container">
            <?php if (isset($data)): ?>
                <h1 class='manga-title'><?= $data['title'] ?></h1>
                <div class="manga-details">
                    <img src="<?= $data['imageUrl'] ?>" alt="<?= $data['title'] ?>" class="manga-image">
                    <div class="manga-info">
                        <h2 class="manga-date-title">Date:</h2>
                        <p class='manga-status'>Status: <?= $data['status'] ?></p>
                        <p class='manga-start-date'>Start date: <?= $data['startDate'] ?></p>
                        <?php if (!isset($data['endDate']) || empty($data['endDate'])) : ?>
                            <p class='manga-end-date'>End date: en cours</p>
                        <?php else : ?>
                            <p class='manga-end-date'>End date: <?= $data['endDate'] ?></p>
                        <?php endif; ?>
                        <h2 class='manga-genres-title'>Genres:</h2>
                        <ul class='manga-genres-list'>
                            <?php foreach ($data['genres'] as $genre) : ?>
                                <li class='manga-genre'><?= $genre['name'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <h2 class='manga-authors-title'>Authors:</h2>
                        <ul class='manga-authors-list'>
                            <?php foreach ($data['authors'] as $author) : ?>
                                <li class='manga-author'>
                                    <?= $author['node']['first_name'] ?> (<?= $author['role'] ?>)
                                </li>
                                <li class='manga-author'>
                                    <?= $author['node']['last_name'] ?> (<?= $author['role'] ?>)
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="manga-synopsis-container">
                    <h2 class='manga-synopsis-title'>Synopsis</h2>
                    <p class='manga-synopsis'><?= $data['synopsis'] ?></p>
                </div>
            <?php else: ?>
                <p>Token de l'API introuvable.</p>
            <?php endif; ?>
        </div>
    </section>


    <section class="additional-images-container">
        <div class="slider-details">
            <div class="slider-wrapper">
                <div class="slider">
                    <?php foreach ($data['pictures'] as $picture) : ?>
                        <?php $pictureUrl = $picture['large'] ?>
                        <div class="slider-item">
                            <img src="<?= $pictureUrl ?>" alt="Additional image">
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <button class="slider-button prev-button">&lt;</button>
            <button class="slider-button next-button">&gt;</button>
        </div>
    </section>



    </main>


    <?php require_once __dir__ . '/footer.php'; ?>

    <script src="Public/script/slider.js"></script>


    </body>
