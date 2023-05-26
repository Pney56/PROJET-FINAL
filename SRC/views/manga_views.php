<div class="manga-grid">
    <?php foreach ($results as $result): ?>
        <?php $manga = $result['node']; ?>

        <div class="manga-card">
            <h3><?php echo htmlspecialchars($manga['title'] ?? ""); ?></h3>
            <div class="manga-image">
                <img src="<?php echo $manga['main_picture']['medium'] ?? "default_image_url.jpg"; ?>" alt="<?php echo htmlspecialchars($manga['title'] ?? ""); ?>">
                <div class="manga-popup">
                    <h4 class="manga-author">Auteur: <?php echo implode(', ', array_map(function ($author) {
                            return $author['node']['first_name'] . ' ' . $author['node']['last_name'];
                        }, $manga['authors'] ?? [])); ?></h4>
                    <p class="manga-synopsis main-manga-synopsis">
                        Synopsis: <?php echo ($manga['synopsis']) && !empty($manga['synopsis']) ? $manga['synopsis'] : "Aucun synopsis pour le moment"; ?>
                    </p>
                </div>
            </div>
            <div class="manga-buttons">
                <?php if ($isProfilePage): ?>
                    <a href="index.php?route=removeFavori&id=<?php echo htmlspecialchars($manga['id'] ?? ""); ?>" class="unfollow-button">Retirer des favoris</a>
                <?php else: ?>
                    <a href="index.php?route=addFavori&id=<?php echo htmlspecialchars($manga['id'] ?? ""); ?>" class="follow-button">Ajouter aux favoris</a>
                <?php endif; ?>
                <a href="index.php?route=manga_details&id=<?php echo htmlspecialchars($manga['id'] ?? ""); ?>" class="details-button">Voir les détails</a>
            </div>
        </div>

    <?php endforeach; ?>
</div>
