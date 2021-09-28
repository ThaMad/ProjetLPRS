$( "body" ).delegate( "#connexion", "click", function() {
    $('#modal-connexion').modal('show')
});

$( "body" ).delegate( "#inscription", "click", function() {
    $('#modal-connexion').modal('hide')
    $('#modal-inscription').modal('show')
});
$( "body" ).delegate( "#mdp-oublier", "click", function() {
    $('#modal-connexion').modal('hide')
    $('#modal-mdp-oublier').modal('show')
});

$( "body" ).delegate( "#inscription-envoi", "click", function(e) {
    e.preventDefault();
    var url = $('#form-inscription').attr('action') ;
    $.ajax({
        type: "post",
        url: url,
        dataType: 'json',
    })
        .done(function(response) {
                alert('success');
        })
        .fail(function(error) {
            alert('error');
        });
});

