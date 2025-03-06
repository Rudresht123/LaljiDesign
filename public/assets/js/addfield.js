function addField(containerId, buttonId, name, placeholder) {
    $("#" + buttonId).on("click", function () {
        $("#" + containerId).append(`
            <div class="col-lg-12 mt-3 removefield">
                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <input type="text" name="${name}" class="form-control" placeholder="${placeholder}">
                        <button type="button" class="btn btn-danger remove-field ms-2"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        `);
    });

    $(document).on("click", ".remove-field", function () {
        $(this).closest(".removefield").remove();
    });
}

$(document).ready(function () {
    addField("email-container", "add-email", "email_id[]", "Enter Email");
    addField("number-container", "add-number", "phone_no[]", "Enter Phone Number");
});
