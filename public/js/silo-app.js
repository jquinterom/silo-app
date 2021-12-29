$(document).ready(function () {
    $("#formFile").on("submit", function(e){
        e.preventDefault();
        let data = new FormData($(this)[0])
        let alertSuccess = $("#alert-success")
        let alertDanger = $("#alert-danger")

        alertSuccess.attr("hidden", true)
        alertDanger.attr("hidden", true)

        $.ajax({
            url: "/api/save-document",
            method: 'POST',
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
            success: function (result) {
                if(result.error){
                    alertDanger.html(result.message)
                    alertDanger.attr('hidden', false)
                } else {
                    alertSuccess.html(result.message)
                    alertSuccess.attr('hidden', false)
                }
            }, error: function (error) {
                alertDanger = $("#alert-danger")
                alertDanger.html(error)
                alertDanger.attr('hidden', false)
            }
        });
    });
})

