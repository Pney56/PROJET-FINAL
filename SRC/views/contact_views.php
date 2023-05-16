<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/css/style.css">
    <script src="Public/script/script.js" defer></script>
    <title>RAIBURARI - Contact</title>
</head>
<body>

<?php require_once __dir__ . '/header.php'; ?>

    <div class="container-manga">
        <h1 class="page-title">Contactez-nous</h1>
        <form class="contact-form" action="index.php?route=submit_contact_form" method="POST">
            <label class="form-label" for="name">Nom :</label>
            <input class="form-input" type="text" name="name" required>
            
            <label class="form-label" for="email">Adresse e-mail :</label>
            <input class="form-input" type="email" name="email" required>
            
            <label class="form-label" for="subject">Sujet :</label>
            <input class="form-input" type="text" name="subject" required>
            
            <label class="form-label" for="message">Message :</label>
            <textarea class="form-input" name="message" required></textarea>
            
            <button class="form-submit" type="submit">Envoyer</button>
        </form>
    </div>


<?php require_once __dir__ . '/footer.php'; ?>

</body>
</html>
