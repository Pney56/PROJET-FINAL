   <div class="container">

        <!-- Bloc pour créer une note -->
        <div class="note-section note-create" id="create-note-block">
            <h2 class="note-header">Créer une note</h2>
            <textarea class="note-input" id="new-note" placeholder="Tapez votre note ici..."></textarea>
            <button class="note-button" id="submit-note">Ajouter la note</button>
        </div>


        <!-- Bloc pour afficher la note existante -->
        <div class="note-section note-display" id="display-note-block">
            <h2 class="note-header">Ma note</h2>
            <p id="note-text"> <!-- La note sera injectée ici via JavaScript --> </p>
            <button class="note-button" id="edit-note">Modifier la note</button>
            <button class="note-button" id="delete-note">Supprimer la note</button>
        </div>


        <!-- Bloc pour modifier la note existante -->
        <div class="note-section note-edit" id="edit-note-block">
            <h2 class="note-header">Modifier la note</h2>
            <textarea class="note-input" id="edit-note-text" placeholder="Modifiez votre note ici..."> <!-- La note sera injectée ici via JavaScript --> </textarea>
            <button class="note-button" id="submit-edited-note">Modifier la note</button>
        </div>
        
    </div>

    <script>
        var apiId = <?php echo $mangaId; ?>; 
    </script>
    <script src="Public/script/notescript.js" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
