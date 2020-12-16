$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    let datatable = $('#sn_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/admin/getSocialNetworks",
            "method": "POST",
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'url', name: 'url'},
            {
                data: 'show_in_register',
                name: 'show_in_register',
                render: function render(data, type, row) {
                    switch (row["show_in_register"]) {
                        case '1':
                            $show = 'Si';
                            break;
                        default:
                            $show = 'No';
                    }
                    return $show;
                }
            },
            {data: 'created_at', name: 'created_at'},
            {
                data: 'image',
                name: 'image',
                searchable: false,
                orderable: false,
                render: function render(data, type, row) {
                    let image = `<img alt='Social Netwotk Logo'
                                        src='/storage/user_images/${row['image']}'
                                        class="img-fluid"
                                        style="max-width: 100px"
                                  >`;

                    return image;
                }
            },
            {
                data: 'action',
                name: 'action',
                searchable: false,
                orderable: false,
                className: 'text-center btn-lg',
                render: function render(data, type, row) {
                    /*Mostrar / No Mostrar*/
                    if (row["show_in_register"] == 0) {
                        button = `<button class='btn btn-danger btn-sm mr-2 changeShow'
                                            type='button' data-id='${row['id']}' title='No mostrar'>
                                        <i class='fas fa-eye'></i>
                                    </button>`;
                    } else {
                        button = `<button class='btn btn-success btn-sm mr-2 changeShow'
                                            type='button' data-id='${row['id']}' title='Mostrar'>
                                        <i class='fas fa-eye'></i>
                                    </button>`;
                    }

                    /*Activar / Desactivar*/
                    if (row["deleted_at"] === null) {
                        button += `<button class='btn btn-danger btn-sm mr-2 changeStatus'
                                            type='button' data-id='${row['id']}' title='Desactivar'>
                                        <i class='fas fa-trash'></i>
                                    </button>`;
                    } else {
                        button += `<button class='btn btn-success btn-sm mr-2 changeStatus'
                                            type='button' data-id='${row['id']}' title='Activar'>
                                        <i class='fas fa-check'></i>
                                    </button>`;
                    }

                    button += `<button class='btn btn-warning btn-sm mr-2 edit'
                                            type='button' data-id='${row['id']}' title='Editar'>
                                        <i class='fas fa-pen'></i>
                                    </button>`;
                    return button;
                }
            }
        ],
        "language": espanol
    });

    $('#sn_table tbody').on('click', '.changeShow', function () {
        let datos = datatable.row($(this).parents()).data();
        let sn_id = datos.id;

        $.post('/admin/social_networks/changeShow', {sn_id}, (response) => {
            if (response == 1) {
                var ref = $('#sn_table').DataTable();
                ref.ajax.reload();
                showMessage('success',2000,'Exito');
            } else {
                showMessage('error',3000,'Error');
            }
        })
        .fail(function (xhr, status, error) {
            showMessage('error', 3000, 'Error');
        });
    });

    $('#sn_table tbody').on('click', '.changeStatus', function () {
        let datos = datatable.row($(this).parents()).data();
        let sn_id = datos.id;

        $.post('/admin/social_networks/changeStatus', {sn_id}, (response) => {
            if (response == 1) {
                var ref = $('#sn_table').DataTable();
                ref.ajax.reload();
                showMessage('success',2000,'Exito');
            } else {
                showMessage('error',3000,'Error');
            }
        })
            .fail(function (xhr, status, error) {
                showMessage('error', 3000, 'Error');
            });
    });

    $('#sn_table tbody').on('click', '.edit', function () {

        $('#currentImage').val('');

        let datos = datatable.row($(this).parents()).data();
        let sn_id = datos.id;
        let name = datos.name;
        let url = datos.url;
        let image = datos.image;

        $('#editName').val(name);
        $('#sn_id').val(sn_id );
        $('#editUrl').val(url);
        $('#currentImage').attr('src',`/storage/user_images/${image}`);

        $('#modalSNEdit').modal()

    });

    $('#btnSaveModal').on('click', function () {
        $('#txtError').empty();
        let fd = new FormData();
        if($('#image').val() != ''){
            let file = $('#image')[0].files[0];
            fd.append('image',file);
        }
        fd.append('sn_id',$('#sn_id').val());
        fd.append('url',$('#editUrl').val());
        fd.append('name',$('#editName').val());

        $.ajax({
            url: '/admin/social_networks/edit',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if (!response.errors) {
                    showMessage('success',2000,'Red Social editada');
                    if($('#image').val() != ''){
                        location.reload();
                    } else {
                        var ref = $('#sn_table').DataTable();
                        ref.ajax.reload();
                    }
                } else {
                    showMessage('error',3000,'Error');
                }
            },
            error:function(xhr, status, error) {
                showMessage('error',3000,'Error');
                let errors = 'Errores: <br>';
                for(let propertyName in xhr.responseJSON.errors) {
                    errors += ' <br> -' + xhr.responseJSON.errors[propertyName][0]
                }
                $('#txtError').html(errors);
            }
        });

    });

});

function showMessage(type = 'success',time = 2000,message){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-center',
        showConfirmButton: false,
        timer: time,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: type,
        title: message
    })
}


let espanol = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
};
