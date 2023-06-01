// Nous avons besoin d'un nom d'utilisateur pour gérer les notes. Assurez-vous de le remplacer par la valeur appropriée.
let username = "username";
let baseUrl = "index.php?route=";

$(document).ready(function() {
    // On initialise avec le bloc de création des notes
    showCreateNoteBlock();

    // Bouton d'ajout de note
    $("#submit-note").click(function() {
        let note = $("#new-note").val();
        if(note) {
            $.ajax({
                type: "POST",
                url: baseUrl + "addNote",
                data: {
                    'username': username,
                    'api_id': 'yourApiId', // Remplacer par l'ID de l'API approprié
                    'note': note
                },
                success: function(data) {
                    // Réinitialiser le texte de la note
                    $("#new-note").val("");
                    // Charger le bloc d'affichage de la note
                    showDisplayNoteBlock(note);
                },
                error: function(data) {
                    console.error("Erreur lors de l'ajout de la note.");
                }
            });
        }
    });

    // Bouton de modification de la note
    $("#edit-note").click(function() {
        let note = $("#note-text").text();
        $("#edit-note-text").val(note);
        showEditNoteBlock();
    });

    // Bouton de suppression de la note
    $("#delete-note").click(function() {
        $.ajax({
            type: "POST",
            url: baseUrl + "deleteNote",
            data: {
                'username': username,
                'api_id': 'yourApiId' // Remplacer par l'ID de l'API approprié
            },
            success: function(data) {
                showCreateNoteBlock();
            },
            error: function(data) {
                console.error("Erreur lors de la suppression de la note.");
            }
        });
    });

    // Bouton de soumission de la note modifiée
    $("#submit-edited-note").click(function() {
        let note = $("#edit-note-text").val();
        if(note) {
            $.ajax({
                type: "POST",
                url: baseUrl + "updateNote",
                data: {
                    'username': username,
                    'api_id': 'yourApiId', // Remplacer par l'ID de l'API approprié
                    'note': note
                },
                success: function(data) {
                    showDisplayNoteBlock(note);
                },
                error: function(data) {
                    console.error("Erreur lors de la mise à jour de la note.");
                }
            });
        }
    });
});

function showCreateNoteBlock() {
    $("#create-note-block").show();
    $("#display-note-block").hide();
    $("#edit-note-block").hide();
}

function showDisplayNoteBlock(note) {
    $("#note-text").text(note);
    $("#create-note-block").hide();
    $("#display-note-block").show();
    $("#edit-note-block").hide();
}

function showEditNoteBlock() {
    $("#create-note-block").hide();
    $("#display-note-block").hide();
    $("#edit-note-block").show();
}
