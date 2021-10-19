$("body").delegate("#modifdata", "click", function () {
    $('#nominfodata').removeAttr('disabled');
    $('#prenominfodata').prop('disabled',false);
    $('#mailinfodata').prop('disabled',false);
    $('#etudiantinfodata').prop('disabled',false);
    $('#parentinfodata').prop('disabled',false);
    $('#classeinfodata').prop('disabled',false);
    $("#save-modification").prop('hidden', false);
    $("#retour").prop('hidden', false);
});

$("body").delegate("#retour", "click", function () {
    $('#nominfodata').prop('disabled',true);
    $('#prenominfodata').prop('disabled',true);
    $('#mailinfodata').prop('disabled',true);
    $('#etudiantinfodata').prop('disabled',true);
    $('#parentinfodata').prop('disabled',true);
    $('#classeinfodata').prop('disabled',true);
    $("#save-modification").prop('hidden', true);
    $("#retour").prop('hidden', true);
});

$("body").delegate("#save-modification", "click", function () {
    if($('#nominfodata').val() == "" || $('#prenominfodata').val() == "" || $('#mailinfodata').val() == "" || $('#classeinfodata').val() == "" ){
        if($('#nominfodata').val() == ""){
            app.displayErrorNotification('Champ nom vide ou incorrect');
        }
        if($('#prenominfodata').val() == ""){
            app.displayErrorNotification('Champ prenom vide ou incorrect');
        }
        if($('#mailinfodata').val() == ""){
            app.displayErrorNotification('Champ mail vide ou incorrect');
        }
        if($('#classeinfodata').val() == ""){
            app.displayErrorNotification('Champ mot de passe vide ou incorrect');
        }
    }
    else
    {
        var action = $('#form-modification-profil').attr('action');
        if ($('#etudiantinfodata').is(':checked')) {
            var profil = $('#etudiantinfodata').val();
        } else if ($('#parentinfodata').is(':checked')) {
            profil = $('#parentrinfodata').val();
        }
        $.ajax({
            type: "post",
            url: action,
            data: {
                'nom': $('#nominfodata').val(),
                'prenom': $('#prenominfodata').val(),
                'mail': $('#mailinfodata').val(),
                'profil': profil,
                'classe': $('#classeinfodata').val()
            },
            success: function (response) {
                app.displaySuccessNotification(response.success);
                // window.location.replace('../../index.php')
            },
            error: function (response) {
                app.displayErrorNotification(response);
            },
        });
    }
});