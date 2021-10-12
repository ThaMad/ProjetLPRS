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
    if($('#nom').val() == "" || $('#prenom').val() == "" || $('#mail_inscript').val() == "" || $('#mdp').val() == "" ){
        if($('#nom').val() == ""){
            app.displayErrorNotification('Champ nom vide ou incorrect');
        }
        if($('#prenom').val() == ""){
            app.displayErrorNotification('Champ prenom vide ou incorrect');
        }
        if($('#mail_inscript').val() == ""){
            app.displayErrorNotification('Champ mail vide ou incorrect');
        }
        if($('#mdp').val() == ""){
            app.displayErrorNotification('Champ mot de passe vide ou incorrect');
        }
    }
    else
    {
        var action = $('#form-inscription').attr('action');
        if ($('#eleveradio').is(':checked')) {
            var profil = $('#eleveradio').val();
        } else if ($('#parentradio').is(':checked')) {
            profil = $('#parentradio').val();
        }
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
            success: function (response) {
                app.displaySuccessNotification(response.success);
                $('#modal-inscription').modal('hide');
                $('#modal-connexion').modal('show');
            },
            error: function (response) {
                app.displayErrorNotification(response);
            },
        });
    }
});

$("body").delegate("#connexion-envoi", "click", function (e) {
    e.preventDefault();
    var action = $('#form-connexion').attr('action');
    $.ajax({
        type: "post",
        url: action,
        data: {
            'mail': $('#mail_connexion').val(),
            'mdp': $('#password').val(),
        },
        success: function () {
            alert('success connexion');
            $('#modal-connexion').modal('hide');
            location.reload();
        },
        error: function () {
            alert('error connexion');
        },
    });
});

