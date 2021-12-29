let alertSuccess = $("#alert-success")
let alertDanger = $("#alert-danger")
let alertWarning = $("#alert-warning")

$(document).ready(function () {

    $("#formFile").on("submit", function(e){
        e.preventDefault();

        let data = new FormData($(this)[0])

        alertSuccess.attr("hidden", true)
        alertDanger.attr("hidden", true)
        alertWarning.attr("hidden", true)

        $.ajax({
            url: "/api/documents",
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
                    // Validamos el error de código
                    if(result.code_error !== 0 ){
                        let listDocumentsExists = "<ul>"
                        result.files_exists.map(function (x){
                            listDocumentsExists = listDocumentsExists +"<li>" + x + "</li>"
                        })

                        listDocumentsExists = listDocumentsExists + "</ul>"
                        alertWarning.html("Los siguientes archivos ya fueron registrados: <br/>" + listDocumentsExists)
                        alertWarning.attr('hidden', false)
                    } else {
                        alertSuccess.html(result.message)
                        alertSuccess.attr('hidden', false)
                    }

                    loadAllDocuments()
                }
            }, error: function (error) {
                alertDanger = $("#alert-danger")
                alertDanger.html(error)
                alertDanger.attr('hidden', false)
            }
        });
    });

    loadAllDocuments()



})

/**
 * Cargar todos los documentos existentes en la base de datos
 * */
function loadAllDocuments(){
    alertSuccess.attr("hidden", true)
    alertDanger.attr("hidden", true)
    alertWarning.attr("hidden", true)

    $.ajax({
        url: "/api/documents",
        method: 'GET',
        processData: false,
        contentType: "application/json",
        success: function (result) {
            let tableBody = $("#tableBody")
            let trs = ""
            tableBody.html("")
            if(result.error){
                tableBody.append("<tr><td>Sin datos...</td></tr>")
            } else {
                result.data.map(function (x){
                    trs = trs + "<tr>" +
                        "<td>"+ x.id +"</td>"+
                        "<td>"+ x.name +"</td>"+
                        "<td><a href='#' class='bi-eye-fill' id='btnViewFile'></a> <a href='#'><span class='bi-trash-fill btn-outline-danger' id='btnDeleteFile'></span> </a></td>"+
                        "</tr>"
                })
                tableBody.append(trs)
            }
        }, error: function (error) {
            alertDanger = $("#alert-danger")
            alertDanger.html(error)
            alertDanger.attr('hidden', false)
        }
    });
}
