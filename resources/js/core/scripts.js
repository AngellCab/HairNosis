
/**
 * handle jquery errors
 *
 * @param {*} jqXhr
 * @param {*} json
 * @param {*} errorThrown
 */
 var catchError = function (jqXhr, json, errorThrown) {
    $.unblockUI()

    var errors     = jqXhr.responseJSON
    var errorsHtml = "<p>"+ errors.message +"</p><ul class='text-left list-inside'>"
    $.each(errors.errors, function (key, value) {
        errorsHtml += '<li>' + value[0] + '</li>'
    });
    errorsHtml += '</ul>'

    Swal.fire('Error', errorsHtml, 'error')
    console.log(jqXhr.responseJSON)
}