$("body").delegate("#addEvent", "click", function () {
    $('#modal-add-event').modal('show');
});

$("body").delegate("#dateD", "change", function () {
    var dateD = $('#dateD').val();
    $('#dateF').attr('min', dateD);
});

$("body").delegate("#dateF", "change", function () {
    var dateF = $('#dateF').val();
    $('#dateD').attr('max', dateF);
});


