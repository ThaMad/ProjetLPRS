$("body").delegate("#tableauEvent", "click", function () {
    $("#containerProfil").prop('hidden', true);
    $("#containerTableau").prop('hidden', false);
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    $("#sectionLien").prop('hidden', true);
});

$("body").delegate("#modifdata", "click", function () {
    $("#containerProfil").prop('hidden', false);
    $("#containerTableau").prop('hidden', true);
    $("#sectionLien").prop('hidden', false);
});

$("body").delegate("#addOrga", "click", function () {
    var event = $('#addOrga').val();
    $("#modal-add-orga").modal('show');
    $('#ajouterEvent').val(event);
});

$("body").delegate("#choixProfil", "change", function () {
    if ($('#eleveradio').is(':checked')) {
        $('#listeEtudiant').prop('hidden', false);
        $('#listeParent').prop('hidden', true);
        $('#selectParent').val('');
        $('#listeProf').prop('hidden', true);
    } else if ($('#parentradio').is(':checked')) {
        $('#listeParent').prop('hidden', false);
        $('#listeEtudiant').prop('hidden', true);
        $('#selectEtudiant').val('');
        $('#listeProf').prop('hidden', true);
    } else if ($('#profradio').is(':checked')) {
        $('#listeProf').prop('hidden', false);
        $('#listeParent').prop('hidden', true);
        $('#selectParent').val('');
        $('#listeEtudiant').prop('hidden', true);
    }
});
