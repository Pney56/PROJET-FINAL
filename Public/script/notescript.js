let username = "username";
let baseUrl = "index.php?route=";
let note_id; // Variable pour stocker l'ID de la note

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(window.location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

$(document).ready(function() {
    let api_id = getUrlParameter('id');

    // Récupérer les notes existantes
    $.ajax({
        type: "GET",
        url: baseUrl + "getNote&id=" + api_id,
        success: function(data) {
            console.log(data);
            if (data.length > 0) {
                note_id = data[0].id_note;
                showDisplayNoteBlock(data[0].note);
            } else {
                showCreateNoteBlock();
            }
        },
        error: function(data) {
            console.error("Erreur lors de la récupération des notes.");
        }
    });

    // Bouton d'ajout de note
    $("#submit-note").click(function() {
        let note = $("#new-note").val();
        if(note) {
            $.ajax({
                type: "POST",
                url: baseUrl + "addNote",
                data: {
                    'username': username,
                    'api_id': api_id,
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
                'note_id': note_id
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
                    'note_id': note_id,
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
    $("#note-view").text(note);
    $("#create-note-block").hide();
    $("#display-note-block").show();
    $("#edit-note-block").hide();
}

function showEditNoteBlock() {
    $("#create-note-block").hide();
    $("#display-note-block").hide();
    $("#edit-note-block").show();
}
