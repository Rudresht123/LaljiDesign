var previous;
$(".select-box").on('focus', function () {
    previous = this.value;
}).change(function () {

    var forid = $(this).data('for');

    $("#" + forid).empty();
    var ismultiple = $("#" + forid).attr('multiple');
    if (ismultiple != "multiple") {
        $("#" + forid).append("<option value=''>---Select---</option>");
    }
    if ($(this).val()) {

        //check request ids
        var requestids = $(this).data('request_ids');
        url_request = "";
        if (requestids) {
            var url_request = [];
            let string = requestids.split(',')
            var selectthis = this;
            $.each(string, function (key, value) {
                if ($("#" + value).val() == 0) {
                    $(selectthis).val(previous);
                    swal("Opps!", "Please select " + value.replace(/[_ ]+/g, " ").trim() + "!", "error");
                    $("#" + value).focus();
                    return false;
                }
                url_request.push("" + value + "=" + $("#" + value).val() + "");
            });
            url_request = "&" + url_request.join("&")
        }
        var url = "/GetSelectBoxDataList/" + $(this).data('get') + "?" + $(this).data('this_id') + "=" + $(this).val() + url_request;

        loader('block');
        formrequestajax('', url, 'GET').success(function (data) {
            var result = $.parseJSON(data);
            if (result) {
                $.each(result, function (key, value) {
                    $("#" + forid).append('<option value="' + key + '">' + value + '</option>');
                });
            } else {
                $("#" + forid).append("<option value=''>No Record Found!</option>");
            }
            if (ismultiple == "multiple") {
                $("#" + forid).multiselect('rebuild');
            }
            loader('none');
        }).fail(function (sender, message, details) {
            loader('none');
            swal("Opps!", "Sorry, something went wrong!", "error");
            return false;
        });
    }
});

// for the table
var previous;
$("table tbody").on('change', '.select-box1', function () {
    var tr = $(this).closest('tr');

    previous = this.value;
    var forid = $(this).data('for');
    alert(forid);
    // Empty the options in the select box that corresponds to the 'forid' within the same row
    tr.find("." + forid).empty();

    var ismultiple = tr.find("." + forid).attr('multiple');
    if (ismultiple != "multiple") {
        tr.find("." + forid).append("<option value=''>---Select---</option>");
    }

    if ($(this).val()) {
        var requestids = $(this).data('request_ids');
        
        var url_request = "";

        // Check for additional request ids and handle them
        if (requestids) {
            var url_request = [];
            let string = requestids.split(',');
            var selectthis = this;

            $.each(string, function (key, value) {
                if (tr.find("." + value).val() == 0) {
                    $(selectthis).val(previous);
                    swal("Oops!", "Please select " + value.replace(/[_ ]+/g, " ").trim() + "!", "error");
                    tr.find("." + value).focus();
                    return false;
                }
                url_request.push("" + value + "=" + tr.find("." + value).val() + "");
            });
            url_request = "&" + url_request.join("&");
        }

        var url = "/GetSelectBoxDataList/" + $(this).data('get') + "?" + $(this).data('this_id') + "=" + $(this).val() + url_request;


        loader('block');
        formrequestajax('', url, 'GET').success(function (data) {
            var result = $.parseJSON(data);
            if (result) {
                $.each(result, function (key, value) {
                    tr.find("." + forid).append('<option value="' + key + '">' + value + '</option>');
                });
            } else {
                tr.find("." + forid).append("<option value=''>No Record Found!</option>");
            }

            if (ismultiple == "multiple") {
                tr.find("." + forid).multiselect('rebuild');
            }
            loader('none');
        }).fail(function (sender, message, details) {
            loader('none');
            swal("Oops!", "Sorry, something went wrong!", "error");
            return false;
        });
    }
});


