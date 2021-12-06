$("body").delegate("#connexion", "click", function () {
    $('#modal-connexion').modal('show')
});

$("body").delegate("#inscription", "click", function () {
    $('#modal-connexion').modal('hide')
    $('#modal-inscription').modal('show')
});
$("body").delegate("#mdp-oublier", "click", function () {
    $('#modal-connexion').modal('hide')
    $('#modal-mdp-oublier').modal('show')
});

$("body").delegate("#inscription-envoi", "click", function (e) {
    e.preventDefault();
    if ($('#nom').val() == "" || $('#prenom').val() == "" || $('#mail_inscript').val() == "" || $('#mdp').val() == "" || (!$('#eleveradio').is(':checked') && !$('#parentradio').is(':checked') && !$('#profradio').is(':checked'))) {
        if ($('#nom').val() == "") {
            app.displayErrorNotification('Champ nom vide ou incorrect');
        }
        if ($('#prenom').val() == "") {
            app.displayErrorNotification('Champ prenom vide ou incorrect');
        }
        if ($('#mail_inscript').val() == "") {
            app.displayErrorNotification('Champ mail vide ou incorrect');
        }
        if ($('#mdp').val() == "") {
            app.displayErrorNotification('Champ mot de passe vide ou incorrect');
        }
        if (!$('#eleveradio').is(':checked') && !$('#parentradio').is(':checked') && !$('#profradio').is(':checked')) {
            app.displayErrorNotification('Champ profil vide ou incorrect');
        }
    } else {
        var mail = $('#mail_inscript').val();
        if (mail.indexOf("ipsum") !== -1) {
            var action = $('#form-inscription').attr('action');
            if ($('#eleveradio').is(':checked')) {
                var profil = $('#eleveradio').val();
            } else if ($('#parentradio').is(':checked')) {
                profil = $('#parentradio').val();
            } else if ($('#profradio').is(':checked')) {
                profil = $('#profradio').val();
            }
            console.log(profil);
            $.ajax({
                type: "post",
                url: action,
                data: {
                    'nom': $('#nom').val(),
                    'prenom': $('#prenom').val(),
                    'mail': $('#mail_inscript').val(),
                    'profil': profil,
                    'mdp': $('#mdp').val()
                },
                success: function () {
                    $('#modal-inscription').modal('hide');
                    $('#modal-connexion').modal('show');
                },
            });
        } else {
            app.displayErrorNotification('Erreur avec le champ mail');
        }
    }
});

$("body").delegate("#connexion-envoi", "click", function (e) {
    e.preventDefault();
    if ($('#mail_connexion').val() == "" || $('#password').val() == "") {
        if ($('#mail_connexion').val() == "") {
            app.displayErrorNotification('Champ mail vide ou incorrect');
        }
        if ($('#password').val() == "") {
            app.displayErrorNotification('Champ mot de passe vide ou incorrect');
        }
    } else {
        var action = $('#form-connexion').attr('action');
        $.ajax({
            type: "post",
            url: action,
            data: {
                'mail': $('#mail_connexion').val(),
                'mdp': $('#password').val(),
            },
            success: function () {
                $('#modal-connexion').modal('hide');
                location.reload();
            },
            error: function () {
            },
        });
    }
});


