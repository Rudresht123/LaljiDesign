
$("body table.datatable tbody tr").click(function(){
var editurl=$(this).attr('editurl');
var deleteurl=$(this).attr('deleteurl');
$("table.datatable tbody tr").removeClass('tr_active');
$(this).addClass('tr_active');
$(".BtnRemoveUrl").attr("href",deleteurl);
$(".BtnEditUrl").val(editurl);
$(".btn-remove").prop('disabled', false);
$(".btn-edit").prop('disabled', false);
});

$(document).keyup(function(e) {
    if (e.key === "Escape") { // escape key maps to keycode 27
        $(".BtnRemoveUrl").attr("href","#");
        $(".BtnEditUrl").val("0");
        $("table.datatable tbody tr").removeClass('tr_active');
        $(".btn-remove").prop('disabled', true);
        $(".btn-edit").prop('disabled', true);
    }
});

$(".BtnRemoveUrl").bind( "click", function( event ) {
    event.preventDefault();
    var deleteurl = $(this).attr("href");
    if (deleteurl != 0) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to Delete the data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, load it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteurl;
            }
        });
    } else {
        alert("Sorry, Edit Url Not Found!, Please Reload Page");
        window.location.reload();
    }
});

