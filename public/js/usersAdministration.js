$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    let datatable = $('#users_table').DataTable({
        processing: true,
        serverSide: true,
        "ajax": {
            "url": "/admin/getUsers",
            "method": "POST",
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {
                data: 'type',
                name: 'type',
                render: function render(data, type, row) {
                    /*0 = user 1 = streamer 2 = admin*/
                    switch (row["type"]) {
                        case '1':
                            $estado = 'Streamer';
                            break;
                        case '0':
                            $estado = 'Usuario';
                            break;
                        case '2':
                            $estado = 'Admin';
                            break;
                        default:
                            $estado = '';
                    }
                    return $estado;
                }
            },
            {data: 'created_at', name: 'created_at'},
            {
                data: 'action',
                name: 'action',
                searchable: false,
                orderable: false,
                className: 'text-center btn-lg',
                render: function render(data, type, row) {
                    if (row["deleted_at"] === null) {
                        button = `<button class='btn btn-danger btn-sm changeStatus'
                                            type='button' data-id='${row['id']}' title='Desactivar'>
                                        <i class='fas fa-trash'></i>
                                    </button>`;
                    } else {
                        button = `<button class='btn btn-success btn-sm changeStatus'
                                            type='button' data-id='${row['id']}' title='Activar'>
                                        <i class='fas fa-check'></i>
                                    </button>`;
                    }
                    button += `<button class='btn btn-warning btn-sm edit'
                                            type='button' data-id='${row['id']}' title='Editar'>
                                        <i class='fas fa-pen'></i>
                                    </button>`;
                    return button;
                }
            }
        ],
        "language": espanol
    });

    $('#users_table tbody').on('click', '.changeStatus', function () {
        let datos = datatable.row($(this).parents()).data();
        let user_id = datos.id;

        $.post('/admin/usuarios/changeUserStatus', {user_id}, (response) => {
            if (response == 1) {
                var ref = $('#users_table').DataTable();
                ref.ajax.reload();
                showMessage('success', 2000, 'Exito')
            } else {
                showMessage('error', 3000, 'Error')
            }
        })
        .fail(function (xhr, status, error) {
            showMessage('error', 3000, 'Error');
        });


    });

    $('#users_table tbody').on('click', '.edit', function () {

        let datos = datatable.row($(this).parents()).data();
        let user_id = datos.id;
        let user_name = datos.name;
        let user_email = datos.email;

        $('#editName').val(user_name);
        $('#user_id').val(user_id);
        $('#editEmail').val(user_email);

        $('#modalUserEdit').modal()

    });

    $('#btnSaveModal').on('click', function () {
        $('#txtError').empty();
        let data = {
            user_id: $('#user_id').val(),
            name: $('#editName').val(),
            email: $('#editEmail').val(),
        };

        $.post('/admin/usuarios/editUser', data, (response) => {
            if (!response.errors) {
                var ref = $('#users_table').DataTable();
                ref.ajax.reload();
                showMessage('success', 2000, 'Usuario editado correctamente');

            } else {
                showMessage('error', 3000, 'Error');

            }
        })
            .fail(function (xhr, status, error) {
                showMessage('error', 3000, 'Error');
                let errors = 'Errores: <br>';
                for (let propertyName in xhr.responseJSON.errors) {
                    errors += ' <br> -' + xhr.responseJSON.errors[propertyName][0]
                }
                $('#txtError').html(errors);
            });

    });

});

function showMessage(type = 'success', time = 2000, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
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
