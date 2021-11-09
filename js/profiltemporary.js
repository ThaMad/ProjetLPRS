$("body").delegate("#tableauEvent", "click", function () {
    $("#containerProfil").prop('hidden', true);
    $("#containerTableau").prop('hidden', false);
});

$("body").delegate("#modifdata", "click", function () {
    $("#containerProfil").prop('hidden', false);
    $("#containerTableau").prop('hidden', true);
});