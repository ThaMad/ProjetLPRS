$("body").delegate("#modifdata", "click", function () {
    $('#nominfodata').removeAttr('disabled');
    $('#prenominfodata').prop('disabled',false);
    $('#mailinfodata').prop('disabled',false);
    $('#profilinfodata').prop('disabled',false);
    $('#classeinfodata').prop('disabled',false);
    $("#save-modification").attr('style', {visibility: visible});
    $("#retour").show();
});