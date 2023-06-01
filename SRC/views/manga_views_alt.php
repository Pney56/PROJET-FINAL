<div class="manga-grid-alt">
    <?php foreach ($results as $result): ?>
        <?php $manga = $result['node']; ?>

        <div class="manga-card-alt">
            <h3><?php echo htmlspecialchars($manga['title'] ?? ""); ?></h3>

                <div class="manga-image-alt">
                    <img src="<?php echo $manga['main_picture']['medium'] ?? "default_image_url.jpg"; ?>" alt="<?php echo htmlspecialchars($manga['title'] ?? ""); ?>">
                </div>

            <div class="manga-buttons-alt">
                <a href="index.php?route=removeFavori&id=<?php echo htmlspecialchars($manga['id'] ?? ""); ?>" class="unfollow-button-alt">Retirer des favoris</a>
                <a href="index.php?route=manga_details&id=<?php echo htmlspecialchars($manga['id'] ?? ""); ?>" class="details-button-alt">Voir les détails</a>
            </div>
        </div>

    <?php endforeach; ?>
</div>
