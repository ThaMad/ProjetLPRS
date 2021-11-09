$("body").delegate("#tableauEvent", "click", function () {
    $("#containerProfil").prop('hidden', true);
    $("#containerTableau").prop('hidden', false);
    $('#table').DataTable({
        "sScrollY": "300px",
        "bScrollCollapse": true,
        "bPaginate": false,
        "bJQueryUI": true,
        paging: false,
        responsive: true,
        "language": {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
        },
        "aoColumnDefs": [
            {"sWidth": "10%", "aTargets": [-1]}
        ]
    });

    $("#table").css("width", "100%")
});

$("body").delegate("#modifdata", "click", function () {
    $("#containerProfil").prop('hidden', false);
    $("#containerTableau").prop('hidden', true);
});

$("body").delegate("#addOrga", "click", function () {
    $("#modal-add-orga").modal('show');
});
$("body").delegate("#choixProfil", "change", function () {
    if ($('#eleveradio').is(':checked')) {
        $('#listeEtudiant').prop('hidden', false);
        $('#listeParent').prop('hidden', true);
        $('#listeProf').prop('hidden', true);
    } else if ($('#parentradio').is(':checked')) {
        $('#listeParent').prop('hidden', false);
        $('#listeEtudiant').prop('hidden', true);
        $('#listeProf').prop('hidden', true);
    } else if ($('#profradio').is(':checked')) {
        $('#listeProf').prop('hidden', false);
        $('#listeParent').prop('hidden', true);
        $('#listeEtudiant').prop('hidden', true);
    }
});
