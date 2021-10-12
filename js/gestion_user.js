$("body").delegate("#add_user", "click", function () {
    $('#add_user').modal('show')
});

$("body").delegate("#sendadd_user", "click", function (e) {
    e.preventDefault();
    var action = $('#form_adduser').attr('action');
    $.ajax({
        type: "post",
        url: action,
        data: {
            'classe':$('#mail').val(),
            'nom': $('#nom').val(),
            'prenom': $('#prenom').val(),
            'mail': $('#mail').val(),
            'profil': $('#profil').val()
        },
        success: function () {
            app.displaySuccessNotification('Vous avez bien ajouté un utilisateur');
            $('#add_user').modal('hide');
        },
        error: function () {
            app.displayErrorNotification('Erreur');
        },
    });
});


