<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note'])) {
    $note = $_POST['note'];
    $username = $_SESSION['username'];
    $api_id = $_POST['api_id'];
    
    // Ajouter la note en utilisant la fonction addNote du contrôleur NotePersonnelController
    $notePersonnelController->addNote($username, $api_id, $note);
    
    // Recharger la page pour afficher la nouvelle note
    header("Location: index.php?route=manga_details&id=$api_id");
    exit;
  }
?>

<div id="notes-personnelles">
  <h2>Mes Notes Personnelles</h2>
  
  <div id="notes-container">
  <?php
    // Afficher les notes personnelles pour l'utilisateur courant
    $notes = $notePersonnelController->getNotes($_SESSION['username']);
    $hasNote = false; // Variable pour vérifier si une note existe déjà pour le manga actuel
    foreach ($notes as $note) {
      if ($note['api_id'] === $api_id) {
        echo "<div>Note : " . $note['note'] . "</div>";
        $hasNote = true;
      }
    }
    if (!$hasNote) {
      echo "<div>Aucune note pour ce manga.</div>";
    }
  ?>
</div>

  <div>
    <form method="POST" action="index.php?route=manga_details&id=<?php echo $api_id; ?>">
      <input type="hidden" name="api_id" value="<?php echo $api_id; ?>">
      <input type="text" name="note" placeholder="Entrez votre note">
      <button type="submit">Ajouter une note</button>
    </form>
  </div>
</div>
