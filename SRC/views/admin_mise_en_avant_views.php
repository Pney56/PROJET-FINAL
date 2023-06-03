<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/css/style.css">
    <script src="Public/script/script.js" defer></script>
    <script src="Public/script/message.php" defer></script>

    <title>RAIBURARI - Admin Mise en avant</title>
</head>

<body>
    <?php require_once __dir__ . '/header.php'; ?>
    <main class="container-mise-en-avant">
        <h1 class="text-center">Gérer la mise en avant des mangas</h1>
        <form action="?route=set_mise_en_avant" method="post" onsubmit="return confirmMiseEnAvant();">
            <label for="manga-select">Sélectionner un manga :</label>
            <select name="manga_id" id="manga-select">
                <?php foreach ($mangas as $manga) : ?>
                    <?php $selected = ($manga['isSelected'] == 1) ? 'selected' : ''; ?>
                    <option value="<?php echo $manga['api_id']; ?>" <?php echo $selected; ?>><?php echo $manga['Titre']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Mettre en avant" class="button">
        </form>


        <div id="popup" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Message</h3>
                <p>Un manga est déjà mis en avant. Vous devez d'abord le retirer avant d'en mettre un autre en avant.</p>
            </div>
        </div>

        <?php if (!empty($mangaMisEnAvant)) : ?>
            <h2 class="text-center">Manga mis en avant :</h2>
            <div class="manga">
                <h3><?php echo $mangaMisEnAvant['Titre']; ?></h3>
                <?php if (isset($mangaMisEnAvant['Description'])) : ?>
                    <p><?php echo $mangaMisEnAvant['Description']; ?></p>
                <?php endif; ?>
                <div class="button-container">
                    <form action="?route=unset_mise_en_avant" method="post">
                        <input type="hidden" name="manga_id" value="<?php echo $mangaMisEnAvant['api_id']; ?>">
                        <input type="submit" value="Supprimer de la mise en avant" class="button">
                    </form>
                </div>
            </div>
        <?php endif; ?>


        <script>
            function confirmMiseEnAvant() {
                var mangaMisEnAvant = <?php echo $mangaMisEnAvant ? 'true' : 'false'; ?>;
                if (mangaMisEnAvant) {
                    return confirm("Un manga est déjà mis en avant. Vous devez d'abord le retirer avant d'en mettre un autre en avant.");
                }
                return true;
            }
        </script>




    </main>
    <?php require_once __dir__ . '/footer.php'; ?>
</body>

</html>
