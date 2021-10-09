var App = function () {

    return {
        displayAjaxError: function (data) {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "400",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "5000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.error(data, 'Error');
        },
        displaySuccessNotification: function (data) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "700",
                "timeOut": "2000",
                "extendedTimeOut": "2000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success(data, 'Success');
        },
        displayErrorNotification: function (data) {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "400",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "5000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.error(data, 'Error');
        },
        drawAjaxLoaderImage: function () {
            return "<img src='responsive/img/ajax-loader.gif' />";
        },
        displayAlertSuccess: function (data) {
            swal({
                title: "OK!",
                text: data,
                type: "success",
                confirmButtonText: "Ok"
            });
        },
        displayAlertError: function (data) {
            swal({
                title: $('#idTransActionNotAuthorized').text(),
                text: data,
                type: "error",
                confirmButtonText: "Ok"
            });
        },
        displayAlertInfo: function (data) {
            swal({
                title: "",
                text: data,
                type: "info",
                confirmButtonText: "Ok"
            });
        },
        displayAlertSuccessRefresh: function (data) {
            swal({
                    title: "Success!",
                    text: data,
                    type: "success",
                    confirmButtonText: "Ok"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        window.location.reload(true);
                    }
                });
        },
        updateURLParameter: function (url, param, paramVal) {
            var newAdditionalURL = "";
            var tempArray = url.split("?");
            var baseURL = tempArray[0];
            var additionalURL = tempArray[1];
            var temp = "";
            if (additionalURL) {
                tempArray = additionalURL.split("&");
                for (i = 0; i < tempArray.length; i++) {
                    if (tempArray[i].split('=')[0] != param) {
                        newAdditionalURL += temp + tempArray[i];
                        temp = "&";
                    }
                }
            }
            var rows_txt = temp + "" + param + "=" + paramVal;
            return baseURL + "?" + newAdditionalURL + rows_txt;
        },
        displayPleaseWait: function () {
            $("#pleaseWaitDialog").modal('show');
        },
        hidePleaseWait: function () {
            $("#pleaseWaitDialog").modal('hide');
        },
        responseJsonErrorNotifications: function (response) {
            if (response.responseJSON.errors !== undefined) {
                $.each(response.responseJSON.errors, function (i, item) {
                    app.displayErrorNotification(i + ' - ' + item);
                });
            } else {
                app.displayErrorNotification(response.responseJSON.message);
            }
        }
    };
};
app = new App();