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

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var result = data;

                if (result) {
                    $.each(result, function (key, value) {
                        $("#" + forid).append('<option value="' + key + '" data-slug="' + value.slug + '">' + value.name + '</option>');
                    });
                } else {
                    $("#" + forid).append("<option value=''>No Record Found!</option>");
                }
                


                // Hide loader
              loader('none');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);

                // Hide loader
                document.getElementById("ld").style.display = "none";
                document.getElementById("overlay").style.display = "none";

                swal("Oops!", "Sorry, something went wrong!", "error");
            }
        });
    }
});

// for the table
var previous;
$("table tbody").on('change', '.select-box1', function () {
    var tr = $(this).closest('tr');

    previous = this.value;
    var forid = $(this).data('for');

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

        document.getElementById("ld").style.display = "block";
        document.getElementById("overlay").style.display = "block";
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log("AJAX Success:", data);

                var result = data;

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

                // Hide loader
                document.getElementById("ld").style.display = "none";
                document.getElementById("overlay").style.display = "none";
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);

                // Hide loader
                document.getElementById("ld").style.display = "none";
                document.getElementById("overlay").style.display = "none";

                swal("Oops!", "Sorry, something went wrong!", "error");
            }
        });


    }
});


