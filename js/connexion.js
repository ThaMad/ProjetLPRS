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
    var action = $('#form-inscription').attr('action');
    if($('#eleveradio').is(':checked')){
        var profil = $('#eleveradio').val();
    }
    else if($('#parentradio').is(':checked')){
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
        success: function () {
                alert('success inscription votre compte doit maintenant être validé par un administrateur');
                $('#modal-inscription').modal('hide');
                $('#modal-connexion').modal('show');
        },
        error: function () {
            alert('error inscription');
        },
    });
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

