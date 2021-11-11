const csrftoken = $('meta[name=csrf-token]').prop('content')

var newUserForm = ''

/**
 * Init data table
 *
 * @param {*} route
 * @param {*} columns
 * @param {*} order
 * @param {*} language
 */
 $.dataTable = function (ajax, routeName, columns, order, language = 'es') {

    var assetPath = '../../../app-assets/',
    userView      = 'app-user-view.html',
    userEdit      = 'app-user-edit.html';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
        userView  = assetPath + 'app/user/view';
        userEdit  = assetPath + 'app/user/edit';
    }

    simpleTable = $('table[data-datatable]').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 250,
        ajax: ajax,
        columns: columns,
        pageLength: 25,
        order: order,
        language: getLanguage(language),
        dom:
            '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            '<"col-lg-12 col-xl-6" l>' +
            '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            '>t' +
            '<"d-flex justify-content-between mx-2 row mb-1"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        buttons: [
            {
                text: 'Add new',
                className: 'add-new btn btn-primary mt-50',
                attr: {
                    // 'data-toggle': 'modal',
                    // 'data-target': '#modals-slide-in'
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');

                    $(node).on('click', function(event) {
                        event.preventDefault()

                        $.ajax({
                            url: routeName + '/create',
                            type: 'get',
                            data: {},
                            success: function (response) {
                                $.unblockUI()
                
                                if (response.error) {
                                    Swal.fire('Error', response.message, 'warning');
                                    return false;
                                }
   
                                $('#form-area').html('')
                                $('#form-area').html(response.form)
                                $('#modals-slide-in').modal('show')

                                $.setValidity()
                                                        
                            }, error: catchError
                        })
                    })
                }
            }
        ],

        // For responsive popup
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Details of ' + data['full_name'];
                    }
                }),
                type: 'column',
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table',
                    columnDefs: [
                        {
                            targets: 2,
                            visible: false
                        },
                        {
                            targets: 3,
                            visible: false
                        }
                    ]
                })
            }
        }
    })

    $('table[data-datatable]').css('width', '100%').removeClass('hidden')
}

/**
 * Init data table
 *
 * @param {*} route
 * @param {*} columns
 * @param {*} order
 * @param {*} language
 */
 $.userDataTable = function (ajax, routeName ,columns, order, language = 'es') {

    statusObj = {
      1: { title: 'Pending',  class: 'badge-light-warning' },
      2: { title: 'Active',   class: 'badge-light-success' },
      3: { title: 'Inactive', class: 'badge-light-secondary' }
    };

    var assetPath = '../../../app-assets/',
    userView      = 'app-user-view.html',
    userEdit      = 'app-user-edit.html';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
        userView  = assetPath + 'app/user/view';
        userEdit  = assetPath + 'app/user/edit';
    }

    simpleTable = $('table[data-datatable]').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 250,
        ajax: ajax,
        columns: columns,
        pageLength: 25,
        order: order,
        columnDefs: [
            {
                // User full name and username
                targets: 0,
                responsivePriority: 4,
                render: function (data, type, object, meta) {
                    
                    var $name = object['name'],
                    $uname    = object['email'],
                    $image    = '' //object['avatar'];

                    if ($image) {
                        // For Avatar image
                        var $output =
                        '<img src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" height="32" width="32">';
                    } else {
                        // For Avatar badge
                        var stateNum = Math.floor(Math.random() * 6) + 1;
                        var states   = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                        var $state   = states[stateNum],
                        $name        = object['name'],
                        $initials    = $name.match(/\b\w/g) || [];
                        $initials    = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                        $output      = '<span class="avatar-content">' + $initials + '</span>';
                    }

                    var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
                    // Creates full output for row
                    var $row_output =
                        '<div class="d-flex justify-content-left align-items-center">' +
                        '<div class="avatar-wrapper">' +
                        '<div class="avatar ' +
                        colorClass +
                        ' mr-1">' +
                        $output +
                        '</div>' +
                        '</div>' +
                        '<div class="d-flex flex-column">' +
                        '<a href="' +
                        userView +
                        '" class="user_name text-truncate"><span class="font-weight-bold">' +
                        $name +
                        '</span></a>' +
                        '<small class="emp_post text-muted">@' +
                        $uname +
                        '</small>' +
                        '</div>' +
                        '</div>';

                    return $row_output;
                }
            },
            {
                // User Role
                targets: 3,
                render: function (data, type, full, meta) {

                    var $role        = full['role'];
                    var roleBadgeObj = {
                        Subscriber: feather.icons['user'].toSvg({class: 'font-medium-3 text-primary mr-50' }),
                        Author:     feather.icons['settings'].toSvg({class: 'font-medium-3 text-warning mr-50' }),
                        Maintainer: feather.icons['database'].toSvg({class: 'font-medium-3 text-success mr-50' }),
                        Editor:     feather.icons['edit-2'].toSvg({class: 'font-medium-3 text-info mr-50' }),
                        Admin:      feather.icons['slack'].toSvg({class: 'font-medium-3 text-danger mr-50' })
                    };
                  
                  return "<span class='text-truncate align-middle'>" + roleBadgeObj[$role] + $role + '</span>';
                }
            },
            {
                // User Status
                targets: 4,
                render: function (data, type, full, meta) {

                    var $status = full['deleted_at'];
                    if ($status == null) {
                        var class_color = statusObj[2].class
                        var title       = statusObj[2].title
                    } else {
                        var class_color = statusObj[3].class
                        var title       = statusObj[3].title
                    }

                    return (
                        '<span class="badge badge-pill ' + class_color + '" text-capitalized>' + title + '</span>'
                    );
                }
            }
        ],
        language: getLanguage(language),
        dom:
            '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            '<"col-lg-12 col-xl-6" l>' +
            '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            '>t' +
            '<"d-flex justify-content-between mx-2 row mb-1"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',

        buttons: [
            {
                text: 'Add New User',
                className: 'add-new btn btn-primary mt-50',
                attr: {
                    // 'data-toggle': 'modal',
                    // 'data-target': '#modals-slide-in'
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    
                    $(node).on('click', function(event) {
                        event.preventDefault()

                        $.ajax({
                            url: routeName + '/create',
                            type: 'get',
                            data: {},
                            success: function (response) {
                                $.unblockUI()
                
                                if (response.error) {
                                    Swal.fire('Error', response.message, 'warning');
                                    return false;
                                }
   
                                $('#form-area').html('')
                                $('#form-area').html(response.form)
                                $('#modals-slide-in').modal('show')

                                $.setValidity()
                                                        
                            }, error: catchError
                        })
                    })
                }
            }
        ],

        // For responsive popup
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Details of ' + data['full_name'];
                    }
                }),
                type: 'column',
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table',
                    columnDefs: [
                        {
                            targets: 2,
                            visible: false
                        },
                        {
                            targets: 3,
                            visible: false
                        }
                    ]
                })
            }
        }
    })

    $('table[data-datatable]').css('width', '100%').removeClass('hidden')
}

newUserSidebar = $('.new-user-modal'),

//set validity
$.setValidity = function(rules = '') {

    // Form Validation
    newUserForm = $('form[data-remote]')
    if (newUserForm.length) {
        newUserForm.validate({
            errorClass: 'error',
            // rules: {
            //     'user-fullname': {
            //     required: true
            //     },
            //     'user-name': {
            //     required: true
            //     },
            //     'user-email': {
            //     required: true
            //     }
            // }
        });

        newUserForm.on('submit', function (e) {
            var isValid = newUserForm.valid();
            e.preventDefault();
            if (isValid) {
                newUserSidebar.modal('hide');
                $('#form-area').html('')
            }
        });
    }
}

/**
 * bind buttons on action column datatables
 * 
 */
$.bindActionButtons = function () {

    $(document).on('click', '.btn-delete, .btn-restore', function(event) {
        event.preventDefault()

        let form = $(this).parents('form')
        confirmAjaxRequest(form)
    })

    $(document).on('click', '.btn-edit', function(event) {
        event.preventDefault()

        let action = $(this).prop('href')

        $.ajax({
            url: action,
            type: 'get',
            data: {},
            success: function (response) {
                $.unblockUI()

                if (response.error) {
                    Swal.fire('Error', response.message, 'warning');
                    return false;
                }

                $('#form-area').html('')
                $('#form-area').html(response.form)
                $('#modals-slide-in').modal('show')

                $.setValidity()

            }, error: catchError
        })
    })
}

/**
 * confirm submit ajax form sweet alert
 *
 * @param {*} show
 */
 $.confirmSubmitAjaxForm = function (show = '') {

    $(document).on('submit', 'form[data-table-confirm], form[data-remote]', function(ev) {
        ev.preventDefault()

        var formData = new FormData(this);
        var form     = $(this);

        Swal.fire({
            title: form.data('remote-confirm-title'),
            text: form.data('remote-confirm-message'),
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: form.data('remote-confirm-button')
        }).then((result) => {
            if (result.isConfirmed) {

                // $.blockUICustom();

                $.ajax({
                    url: form.prop('action'),
                    type: form.prop('method'),
                    headers: {
                        'X-CSRF-TOKEN': csrftoken
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $.unblockUI();

                        if (response.error) {
                            if (response.html) {
                                Swal.fire({title: 'Error', html: response.html, icon: 'warning'})
                                return false
                            }

                            Swal.fire('Error', response.message, 'warning')
                            return false
                        }

                        Swal.fire('Ok!', form.data('remote-success-message'), 'success')

                        if (typeof simpleTable != 'undefined') {
                            simpleTable.ajax.reload(function (json) {
                                if (typeof trashTable !== 'undefined') {
                                    setTimeout(function () {
                                        trashTable.ajax.reload(null, false);
                                    }, 500)
                                }
                            }, false)
                        }

                    }, error: catchError
                })
            }
        })
    })
}

/**
 * call ajax with confirm ask request
 * 
 * @param {*} form 
 */
function confirmAjaxRequest(form) {

    Swal.fire({
        title: form.data('confirm-title'),
        text: form.data('confirm-message'),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: form.data('confirm-button')
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: form.prop('action'),
                type: form.prop('method'),
                data: form.serialize(),
                success: function (response) {
                    $.unblockUI();

                    if (response.error) {
                        if (response.html) {
                            Swal.fire({title: 'Error', html: response.html, icon: 'warning'})
                            return false
                        }

                        Swal.fire('Error', response.message, 'warning')
                        return false
                    }

                    Swal.fire('Ok!', form.data('success-message'), 'success')

                    if (typeof simpleTable != 'undefined') {
                        simpleTable.ajax.reload(function (json) {
                            if (typeof trashTable !== 'undefined') {
                                setTimeout(function () {
                                    trashTable.ajax.reload(null, false);
                                }, 500)
                            }
                        }, false)
                    }

                }, error: catchError
            })
        }
    })
} 

// Check Validity
function checkValidity(el) {
    if (el.validate().checkForm()) {
      submitBtn.attr('disabled', false);
    } else {
      submitBtn.attr('disabled', true);
    }
}

// To initialize tooltip with body container
$('body').tooltip({
    selector: '[data-toggle="tooltip"]',
    container: 'body'
});

/**
 * get language
 * 
 * @param {*} language 
 * @returns 
 */
function getLanguage(language = 'es') {

    var lang;

    if(language == 'en') {
        lang = {
            "decimal":        "",
            "emptyTable":     "No data available in table",
            "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty":      "Showing 0 to 0 of 0 entries",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Show _MENU_ entries",
            "loadingRecords": "Loading...",
            "processing":     "Processing...",
            "search":         "Search:",
            "zeroRecords":    "No matching records found",
            "paginate": {
               "previous": '&nbsp;',
                "next": '&nbsp;'
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    }
    else{
        lang = {
            "decimal":        "",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "info":           "Mostrando registros del _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered":   "(filtrado de _MAX_ registros totales)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Búsqueda:",
            "zeroRecords":    "No se encontraron registros coincidentes",
            "paginate": {
                "previous": '&nbsp;',
                 "next": '&nbsp;'
             },
            "aria": {
                "sortAscending":  ": activar para ordenar la columna ascendente",
                "sortDescending": ": activar para ordenar la columna descendente"
            }
        }
    }

    return lang;
}

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