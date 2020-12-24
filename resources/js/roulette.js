$(document).ready(function(){
    tabla_ruleta();

    const swalDelete = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    function tabla_ruleta(){
        let estado;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let datatable = $('#tabla_ruleta').DataTable({
            processing: true,
            serverSide:true,
            "ajax": {
                "url": "/streamer/roulette/getroulette",
                "method": "POST",
            },
            columns: [
                {data: 'reward', name: 'reward'},
                {data: 'participants_number', name: 'participants_number'},
                {data: 'status', "render": function ( data, type, row ){
                        if (row["status"] == 1) {
                            estado = '<span class="badge badge-info">Activado</span>';
                        }else if(row["status"] == 2){
                            estado = '<span class="badge badge-warning">Desactivado</span>';
                        }else{
                            estado = '<span class="badge badge-danger">Sin estado</span>';
                        }
                        return estado;
                    }
                },
                { "defaultContent": `
                                    <button class="btn btn-success btn-sm activar" type="button" data-toggle="modal" title="Activar"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-warning btn-sm desactivar" title="Desactivar"><i class="fas fa-times"></i></button>
                                    <button class="btn btn-danger btn-sm borrar" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                    <button class="btn btn-info btn-sm ganadores" title="Ir a Ruleta"><i class="fas fa-trophy"></i></button>
                `}
            ],
            "language": espanol
        });

        $('#tabla_ruleta tbody').on('click', '.activar', function() {
            var datos = datatable.row($(this).parents()).data();
            var id = datos.id;
            $.post('/streamer/roulette/activateroulette', {
                id: id
            }, function (response) {
                if (response == 'activado') {
                    var ref = $('#tabla_ruleta').DataTable();
                    ref.ajax.reload();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Ruleta activada'
                    })
                } else if(response == 'noaddactive'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Hay una ruleta activa, desactivala o borrala primero!'
                    });
                }else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'No se pudo activar la ruleta seleccionada'
                    })
                }
            });
        });

        $('#tabla_ruleta tbody').on('click', '.desactivar', function() {
            var datos = datatable.row($(this).parents()).data();
            var id = datos.id;
            $.post('/streamer/roulette/deactivateroulette', {
                id: id
            }, function (response) {
                if (response == 'desactivado') {
                    var ref = $('#tabla_ruleta').DataTable();
                    ref.ajax.reload();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'info',
                        title: 'Ruleta desactivada'
                    })
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'No se pudo desactivar la ruleta seleccionada'
                    })
                }
            });
        });

        $('#tabla_ruleta tbody').on('click', '.borrar', function() {
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;
            swalDelete.fire({
                title: '¿Desea eliminar la ruleta?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('/streamer/roulette/deleteroulette', {id}, (response) => {
                        if (response == 'deleted') {
                            var ref = $('#tabla_ruleta').DataTable();
                            ref.ajax.reload();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            });

                            Toast.fire({
                                icon: 'warning',
                                title: 'Ruleta borrada'
                            })
                        }else{
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            });

                            Toast.fire({
                                icon: 'error',
                                title: 'No se pudo borrar la ruleta seleccionada'
                            })
                        }
                    });
                }
            });
        });

        $('#tabla_ruleta tbody').on('click', '.ganadores', function() {
          let datos = datatable.row($(this).parents()).data();
          let id = datos.id;
          let estado = datos.status;
          if (estado == 1) {
            window.open('/streamer/ruleta/ganadores/'+id, '_blank');
          }else{
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Debe de activar la ruleta!'
              });
          }

        });
    }

    $('#form-generar').submit(e => {
        let reward = $('#reward').val();
        if (reward.length > 0) {
            $.post('/streamer/roulette/create_roulette', {reward}, function(response){
                if (response == 'add') {
                    $('#add').hide('slow');
                    $('#add').show(2000);
                    $('#add').hide(2000);
                    $('#form-generar').trigger('reset');
                    var ref = $('#tabla_ruleta').DataTable();
                    ref.ajax.reload();
                }else if(response == 'noaddactive'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Posees una ruleta activa, desactivala para agregar una nueva!'
                    })
                }else{
                    $('#form-generar').trigger('reset');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ya pasaste el limite de ruletas por dia!'
                    })
                }
            });
        }else{
            $('#noadd-emp').hide('slow');
            $('#noadd-emp').show(2000);
            $('#noadd-emp').hide(5000);
        }
        e.preventDefault();
    });



});

let espanol = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
};
