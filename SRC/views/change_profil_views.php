<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/css/style.css">
    <script src="Public/script/script.js" defer></script>
    <title>RAIBURARI - Modifier profil</title>
</head>

<body>

    <?php require_once __dir__ . '/header.php'; ?>

    <main class="fond-sombre">
        <div class="manga-theme">
            <form action="index.php?route=update_profile" method="POST" class="formulaire-modifier">

                <div>
                    <p>Votre Pseudo : <?php echo $_SESSION['username']; ?> </p>
                </div>
                <div>
                    <p>Votre adresse email : <?php echo $_SESSION['email']; ?> </p>
                </div>
                <div>
                    <label for="password">Mot de passe actuel :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="new_password">Nouveau mot de passe :</label>
                    <input type="password" id="new_password" name="new_password">
                </div>
                <div>
                    <label for="confirm_new_password">Confirmez le nouveau mot de passe :</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password">
                </div>
                <input type="submit" value="Mettre à jour le profil">
            </form>
            
        
            <form action="index.php?route=delete_profile" method="POST" class="delete-profile-form" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
                <button type="submit" class="btn btn-danger">Supprimer le profil</button>
            </form>


        </div>
    </main>


    <?php require_once __dir__ . '/footer.php'; ?>

</body>

</html>