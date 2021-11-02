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

// $("body").delegate("#ajouterEvent", "click", function () {
//     var dateD = $('#dateD').val();
//     var dateF = $('#dateF').val();
//     var libelle = $('#libelle').val();
//     var description = $('#description').val();
//     var image = $('#inputImage').val().substring(12);
//     var file = $('#inputImage').attr('name');
//     if(dateD !== '' && dateF !== '' && libelle !== '' && description !== '') {
//         var action = $('#form-add-event').attr('action');
//         $.ajax({
//             type: "post",
//             url: action,
//             data: {
//                 'libelle': libelle,
//                 'dateD': dateD,
//                 'dateF': dateF,
//                 'description': description,
//                 'image': image,
//                 'file': file
//             },
//             success: function (response) {
//                 app.displaySuccessNotification(response.success);
//
//             },
//             error: function (response) {
//                 app.displayErrorNotification(response);
//             },
//         });
//     }else{
//         app.displayErrorNotification();
//     }
// });

